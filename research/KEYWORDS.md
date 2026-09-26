# Keyword Research: knowledgeparkguide.in (Milestone I draft v1)

**Data:** Google Autocomplete (India, `gl=in`) harvested **25 Sep 2026** from **46 seed queries**, giving **1,636 unique suggestions** ([autocomplete.csv](autocomplete.csv), script [harvest.py](harvest.py)).
**Filtered:** 1,307 relevant to the audience and 329 dropped (far cities, Greater Noida West, brands, schools, news, jobs).
**SERP checks:** done with a US-based search index. Re-check the primaries on **google.co.in in incognito** and take screenshots (Week 4).
**KD / volume:** **not measured yet.** The ease scores below are judged from who ranks. Fill in the tool numbers in [keyword-metrics.csv](keyword-metrics.csv).

---

## 1. Niche, audience, SEO problem

**Niche:** an independent, first-hand student-living guide to **Knowledge Park, Greater Noida and the campuses around it**, covering getting here, where to stay, what to eat and what to do.

> ⚠️ **Geography note (viva question waiting to happen):** **Bennett University (Tech Zone II)** and **Galgotias University (Sector 17A, Yamuna Expressway)** are *not inside* Knowledge Park. Sharda, GL Bajaj (KP-III) and GCET (KP-II) are. Frame the site as **"Knowledge Park & around"**. Knowledge Park is the hub every student travels through, so the name still holds. Also say **"Greater Noida (not Greater Noida West)"** on pages. 28 of the dropped suggestions show searchers mix up the two.

**Audience personas**
| Persona | Needs | Top queries |
|---|---|---|
| **The fresher** (1st year, often from outside NCR) | Reaching campus from the airport or railway station, food, PG vs hostel | bennett university nearest metro station · how to reach bennett university from delhi · restaurants near bennett university |
| **The day scholar** (commutes from Delhi/Noida) | Metro route, last metro, auto/e-rickshaw fares | how to reach greater noida by metro · pari chowk last metro time · auto fare in greater noida |
| **The PG hunter** (2nd/3rd year moving out of the hostel) | Budget, safety, food, distance to gate | pg near galgotias university under 5000 · how to find pg in greater noida · is greater noida safe for students |
| **The visiting parent** | Safety, route, where to stay | is greater noida safe · delhi airport to bennett university |

**SEO problem statement (144 words, drop into the report):**
> Students at Greater Noida's Knowledge Park colleges (Sharda, GL Bajaj, GCET) and nearby campuses such as Bennett and Galgotias University rely on Google to learn how to get there, where to stay and what to eat. A Google Autocomplete harvest on 25 September 2026 returned 1,636 unique suggestions from 46 seed queries, 1,307 of them relevant to this audience. Yet the pages ranking for these queries are weak. For "bennett university nearest metro station", the #1 result is a 2018 conference page, now erroring, that predates the 2019 Aqua Line; seven ranking pages give six different "nearest metro" answers. "restaurants near bennett university" returns hotel-booking pages. PG queries return aggregators and PG operators' promotional blogs. Route pages contradict each other on last-metro times and campus distances. No independent, first-hand, dated guide exists. knowledgeparkguide.in targets this gap with verified, on-the-ground content for low-competition long-tail queries.

---

## 2. Focus keywords (15), one page each

"Variants" = number of autocomplete suggestions that map to the page (a demand signal). Ease: 5 = weakest SERP.

| # | Keyword | Target page | Intent | Variants | Who ranks now | Ease |
|---|---|---|---|---|---|---|
| 1 | bennett university nearest metro station | /getting-here/bennett-university-nearest-metro-station/ | Informational | 46 | 2017–18 conference pages (pre-Aqua Line: Botanical Garden + bus), Moovit, careers360 Q&A ("proposed metro", 2018) | **5** |
| 2 | restaurants near bennett university | /eat/food-near-bennett-university/ | Commercial | 3 | Hotel-booking pages (Expedia, Goibibo): wrong intent, no food guide | **5** |
| 3 | galgotias university nearest metro station | /getting-here/nearest-metro-station-galgotias-sharda-gl-bajaj/ | Informational | 48 | Quora, YouTube short, thin auto-generated pages that contradict each other (13 km vs 1 km) | 4 |
| 4 | auto fare in greater noida | /getting-here/ (hub) | Informational | 70 | Cab aggregators, a *Noida* fare card; no Greater Noida auto/e-rickshaw fares anywhere | 4 |
| 5 | greater noida metro ticket whatsapp number | /getting-here/greater-noida-metro-tickets/ | Informational | 27 | News post on X, app store listings, one explainer | 4 |
| 6 | pari chowk to botanical garden bus | /getting-here/pari-chowk-to-botanical-garden-bus/ | Informational | 31 | Rome2rio, Quora ×2, Moovit PDF | 4 |
| 7 | pg near bennett university | /stay/pg-near-bennett-university/ | Commercial | 21 | Careers360 Q&A, Stanza, NoBroker, spam directory pages; no student guide | 4 |
| 8 | pg near galgotias university | /stay/pg-near-galgotias-university/ | Commercial | 14 | Stanza, Quora, 99acres, single-PG sites | 4 |
| 9 | how to find pg in greater noida | /stay/how-to-find-pg-greater-noida/ | Informational | 10 | All listing pages plus one Quora thread; no how-to guide | 4 |
| 10 | is greater noida safe for students | /living/is-greater-noida-safe-for-students/ | Informational | 10 | YouTube, Quora, AI-sounding local blog, a 2007 news page | 4 |
| 11 | late night food greater noida | /eat/late-night-food-greater-noida/ | Commercial | 8 | Tripadvisor filter, *Noida* (not Greater Noida) pages | 4 |
| 12 | pari chowk food | /eat/pari-chowk-food/ | Commercial | 31 | Directories only (Zomato, magicpin, Sulekha) | 4 |
| 13 | cafe near knowledge park | /eat/cafes-near-knowledge-park/ | Commercial | 18 | Zomato page of a café literally named "Cafe Knowledge Park", directories | 4 |
| 14 | knowledge park greater noida pin code | /living/knowledge-park-sectors-pin-codes/ | Informational | 53 | Wikipedia, 99acres, pincode directories that disagree (201310 vs 201306) | 3 |
| 15 | how to reach greater noida by metro | /getting-here/delhi-to-greater-noida-by-metro/ | Informational | 380 | Rome2rio ×2, Quora, one small local blog | 3 |

**Secondary / hub terms** (likely KD > 20; impressions only, don't promise rankings):
knowledge park greater noida (Home) · greater noida metro timings · pg in knowledge park greater noida (/stay/ hub) · girls pg in greater noida · things to do in greater noida with friends (/explore/ hub) · cost of pg in greater noida

**Intent mix:** 9 Informational, 6 Commercial. We deliberately **don't target Transactional or Navigational** queries (e.g. "stanza living greater noida", "nmrc app"): brands own them and a new site can't win them. Say this in the report; it's a rubric point, not a gap.

## 3. Long-tail & LSI terms (rubric table)

Competition is judged from the SERP (Low/Med/High). Relevance: 5 = core to the target page.

| Term | Type | Page | Competition | Relevance |
|---|---|---|---|---|
| bennett university ke nearest metro station | Long-tail (Hinglish) | Bennett metro | Low | 5 |
| pari chowk last metro time | Long-tail | Bennett metro / timings | Low (SERPs contradict: 10:08–11:45 pm) | 4 |
| pg near galgotias university under 5000 | Long-tail | PG Galgotias | Low | 5 |
| girls pg in greater noida near knowledge park 2 | Long-tail | Girls PG | Med | 4 |
| cafe near knowledge park metro station | Long-tail | Cafés KP | Low | 5 |
| is greater noida safe at night | Long-tail | Safety | Low | 5 |
| knowledge park 3 greater noida pin code | Long-tail | Sectors/pin codes | Low | 5 |
| Aqua Line / NMRC / Knowledge Park II metro station | LSI entities | All getting-here pages | n/a | 5 |
| e-rickshaw fare, shared auto, Rapido | LSI | Hub + every route page | n/a | 4 |
| single / double sharing, with food, security deposit | LSI | All /stay/ pages | n/a | 5 |

## 4. Tool lookup plan (fits the free limits)

| When | Tool | What | Screenshot → |
|---|---|---|---|
| Day 1 | **Semrush** free, *India* database (10/day) | Keyword Overview for #1–10 | SV, KD %, intent |
| Day 2 | Semrush | #11–15 + 5 secondary terms | same |
| Day 1–2 | **Ahrefs free KD checker** (India) | all 15 (solve the CAPTCHA) | KD 0–100 |
| Day 3 | **KWFinder** free (5/day), location **Greater Noida** or Uttar Pradesh | the 5 that show 0 or n/a in Semrush | local SV + KD |
| Optional | **Google Keyword Planner** (asks for billing details, you enter them, no spend, no campaigns) | all 20, location Greater Noida | volume ranges |
| Any day | AnswerThePublic (3/day) | "bennett university", "pg in greater noida", "greater noida metro" | question keywords |

**Expect 0 or n/a volume on many of these.** That's normal for hyperlocal queries. Evidence chain for the report: Keyword Planner city range → parent-topic volume (e.g. "pg in greater noida") → the autocomplete variant count above → **GSC impressions once indexed** (strongest). Ahrefs has published research showing that "0-volume" keywords still get real impressions; cite it.

If a primary comes back **KD > 20**, swap it for its long-tail (e.g. "greater noida metro timings" → "pari chowk last metro time").

## 5. Site structure & publishing waves (draft v0, finalized in Week 5)

Categories: **/getting-here/ · /stay/ · /eat/ · /explore/ · /living/** (area info: safety, pin codes, colleges, costs).

| Wave | When | Pages |
|---|---|---|
| **1** | Weeks 3–5 (Oct) | Home · About · **Bennett nearest metro** (flagship in-depth post) · Restaurants near Bennett · PG near Bennett · Galgotias/Sharda/GL Bajaj nearest metro |
| **2** | Weeks 6–9 | Metro tickets (WhatsApp/card) · Pari Chowk → Botanical Garden bus · Safety · Late-night food · Pari Chowk food · Cafés near KP · How to find a PG · /getting-here/ hub (auto fare table) |
| **3** | Weeks 9–11 | Pin codes & sectors · Delhi → Greater Noida by metro · Airport/railway station routes (matches the December travel peak) · PG near Galgotias · Cost of PG · PG near Sharda/GL Bajaj · /eat/ + /stay/ hubs |
| Later | If time allows | Metro timings (hard) · Girls PG (hard) · Colleges list · Cost of living · Bennett hostel · /explore/ hub · Grand Venice · Movies · Birthday cafés · Essentials · AQI |

**Anti-cannibalization rules**
1. One primary keyword per page. It appears only in that page's title and H1.
2. Bennett gets its own pages because its geography really is different (Tech Zone II, PG pockets in Xu-3/Omicron/Mu). **No "PG near <college>" page without distinct first-hand data**, otherwise it's a doorway page.
3. Sharda + GL Bajaj share one PG page (both KP-III).
4. College-specific girls-PG queries stay on the college page; the girls-PG page covers area-level only.
5. Home owns "knowledge park greater noida" and links out; it doesn't carry the pin-code table.

## 6. Field data for Wave 1 (start collecting now)

**Bennett nearest metro**
- Which station is actually nearest (Depot? Pari Chowk? KP-II), with the measured road distance to the gate.
- Auto/e-rickshaw fare and time from each, day vs after 9 pm.
- Does Bennett run a shuttle? Get the timetable.
- Uber/Ola quote screenshots from IGI T3, New Delhi Railway Station, Anand Vihar and Ghaziabad Junction.
- One timed metro journey from New Delhi Railway Station to the gate, with every change.

**Restaurants near Bennett**
- On-campus outlets with block, hours (check the "24/7" claims at night) and 3–5 benchmark prices.
- Mess timings and cost per meal.
- Which delivery apps reach which gate, last-order time, and timestamped delivery screenshots.
- The 5–10 nearest off-campus places: distance, fare, price for two.

**PG near Bennett**
- Which pockets have student PGs within 2 km (Xu-3, Omicron, Mu, Kyampur, Raipur?).
- A rent table for 10+ PGs: sharing type, AC, food, deposit, electricity, in-time.
- A quick anonymous survey of 10–15 students living outside.
- Photos (with the owner's permission, no faces).

**Galgotias / Sharda / GL Bajaj metro**
- Per campus: nearest station, gate, road distance, fare, time.
- Is walking from KP-II to Sharda/GL Bajaj feasible and safe after dark?
- Any college shuttles?

**Every page:** put a **"last checked: <date>"** on each fare, timing and price table. Accuracy is the one thing the competition gets wrong.

---

