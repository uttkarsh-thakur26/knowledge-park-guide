"""Harvest Google Autocomplete (gl=in) suggestions for seed keywords -> research/autocomplete.csv.

Usage: python3 research/harvest.py
Evidence for the report: the CSV records the date and the seed that produced each suggestion.
"""
import csv, json, pathlib, string, time, urllib.parse, urllib.request
from datetime import date

SEEDS = {
    "transport": [
        "bennett university metro", "how to reach bennett university", "bennett university nearest metro station",
        "knowledge park 2 metro station", "pari chowk to", "knowledge park to", "greater noida metro",
        "aqua line metro", "sharda university metro station", "galgotias university metro",
        "gl bajaj greater noida metro", "delhi to bennett university", "e rickshaw greater noida",
        "auto fare greater noida", "noida to greater noida",
    ],
    "stay": [
        "pg near bennett university", "pg near sharda university", "pg near galgotias university",
        "pg near gl bajaj", "pg in knowledge park", "hostel near sharda university", "bennett university hostel",
        "pg in greater noida", "girls pg in greater noida", "boys pg in greater noida",
    ],
    "food_explore": [
        "restaurants near bennett university", "cafes in greater noida", "food near sharda university",
        "pari chowk food", "cafe near knowledge park", "best food in greater noida", "street food in greater noida",
        "things to do in greater noida", "places to visit in greater noida", "grand venice mall",
        "movie theatre in greater noida", "late night food greater noida",
    ],
    "general": [
        "knowledge park greater noida", "cost of living in greater noida", "is greater noida safe",
        "greater noida for students", "life at bennett university", "bennett university campus",
        "colleges in knowledge park", "sharda university campus", "galgotias university campus",
    ],
}
# a-z expansion only for the seeds most likely to have deep long-tails (keeps requests polite)
DEEP = {"pg near bennett university", "bennett university nearest metro station", "knowledge park greater noida",
        "things to do in greater noida", "cafes in greater noida", "pg in greater noida", "greater noida metro",
        "pari chowk to", "knowledge park to", "restaurants near bennett university"}


def suggest(q):
    url = "https://suggestqueries.google.com/complete/search?client=firefox&hl=en&gl=in&q=" + urllib.parse.quote(q)
    with urllib.request.urlopen(url, timeout=10) as r:
        return json.loads(r.read().decode("utf-8", "replace"))[1]


def main():
    out = pathlib.Path(__file__).with_name("autocomplete.csv")
    seen, rows, today = set(), [], date.today().isoformat()
    for cluster, seeds in SEEDS.items():
        for seed in seeds:
            queries = [seed] + ([f"{seed} {c}" for c in string.ascii_lowercase] if seed in DEEP else [])
            for q in queries:
                try:
                    results = suggest(q)
                except Exception as e:  # one failed query shouldn't kill the run
                    print("skip", q, e)
                    continue
                for s in results:
                    if s not in seen:
                        seen.add(s)
                        rows.append((cluster, seed, q, s, today))
                time.sleep(0.3)
    with out.open("w", newline="") as f:
        w = csv.writer(f)
        w.writerow(["cluster", "seed", "query", "suggestion", "date"])
        w.writerows(rows)
    print(f"{len(rows)} unique suggestions -> {out}")


if __name__ == "__main__":
    main()
