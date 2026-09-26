# SERP & Competitor Analysis: knowledgeparkguide.in (Milestone I)

*Compiled 26 Sep 2026 from live page fetches.*

## SERP & Ranking Analysis

### Method

| Item | Detail |
|---|---|
| Date | 26 Sep 2026 |
| Keywords analysed | 6 priority keywords from KEYWORDS.md: #1 bennett university nearest metro station, #2 restaurants near bennett university, #3 galgotias university nearest metro station, #4 auto fare in greater noida, #7 pg near bennett university, #10 is greater noida safe for students. A "… greater noida" variant was also run where the base query was thin or ambiguous. |
| SERP source | A web search API. It uses a **US-based index** and returns only an organic link list, so featured snippets, PAA, local packs, video carousels and AI Overviews could not be seen. Positions, Hindi/Hinglish results and local packs on google.co.in may differ. |
| Page evidence | Each ranking URL was fetched with curl (normal browser User-Agent) or a headless fetcher. JS-heavy pages (Quora, MakeMyTrip, BlaBlaCar, Rapido) were read in a rendered browser. When a live page errored, a Wayback Machine snapshot was counted instead (ictiee, metroxp). |
| Word counts | Visible main-content words only (main / article / .entry-content, without nav, header, footer or sidebar). Where a count used a different scope, the table says so. |
| Dates | Taken from the page: visible dates, `<time>`, article:published/modified_time, or JSON-LD datePublished/dateModified. |
| Structure / schema | Heading outline, tables, FAQ, maps and images read from the HTML. Schema types read from JSON-LD or microdata in the served HTML. |
| Question keywords | Autocomplete-style question variants, collected as a stand-in for PAA because PAA boxes could not be seen. |
| Distances | Straight-line distances calculated from OpenStreetMap coordinates where marked. Ground truth for Pari Chowk ↔ Bennett is the author's field check (below). |
| Blocked, not bypassed | Moovit (403), Quora (Cloudflare), Shiksha (403), Expedia (429 bot check), Justdial (403/empty), Rome2rio (403), and a DuckDuckGo India-region cross-check (CAPTCHA). These are recorded as "n/o". |
| **To add manually** | Search google.co.in in an incognito window with location set to India, one search per keyword. Screenshot the whole SERP: featured snippet, PAA, local pack, video results, AI Overview and Discussions & forums. Note any position that differs from the tables below. |

**Author field check (Sep 2026):** Pari Chowk metro to Bennett University is about 11 km and takes 20–25 min by auto. Auto drivers ask ₹150–200. Uber and Rapido give steadier prices. Fares rise before and around holidays. Don't pay more than ₹200.
Legend: n/o = not observed. V = variant query. R = related query.

---

### 1. bennett university nearest metro station

| # | URL (domain) | Type | Words | Updated | Structure / schema | Issue |
|---|---|---|---|---|---|---|
| 1 | [ictiee.org](https://ictiee.org/ictiee2018/greater-noida/) | 2018 conference page | 1,363 (332 on transport). Counted from the Wayback snapshot of 10 Oct 2025; the live URL returns HTTP 500 | 2018-01-03 | 5 H1s, no H2; 1 hotel table; 3 map iframes (one points to Madurai); Breadcrumb microdata only | Route is Botanical Garden → UPSRTC bus → auto ₹50–150. No Aqua Line (it opened 25 Jan 2019). Text is duplicated on icmlds. The URL is down but still ranks #1 |
| 2 | [moovitapp.com](https://moovitapp.com/index/en/dir/Bennett_University-stop_36609992-site_153561293-3801) | Programmatic transit | n/o (403) | n/o | n/o | Title reads "Noida Sector 52 to Bennett University", i.e. an auto-generated route page |
| 3 | [icmlds.com](https://icmlds.com/icmlds2017/travelguide) | 2017 conference page | 236 | None shown (© 2017) | No H1/H2; 1 map, 2 images; no schema | Duplicates #1. `<title>` says "Committees". Ranks on the exact phrase "How to Reach Bennett University". PIN 201310 |
| 4 | [moovitapp.com](https://moovitapp.com/index/en/public_transit-Bennett_University-Delhi-site_153561293-3801) | Programmatic transit | n/o (403) | n/o | n/o | Title puts Bennett "in New Delhi" (wrong city) |
| 5 | [collegewollege.com](https://collegewollege.com/university/bennett-university-c10102/accessibility) | College-portal tab | 824 (1,125 with page chrome) | Three dates: schema 2026-09-17, visible 3 Sep 2026, "Fact-Checked 02/09/2026" | H1, 1 H2, H3s By Air / Bus / Train / Metro / FAQs; TOC; 5-Q FAQ; Article, FAQPage, CollegeOrUniversity, BreadcrumbList | Newest page, but it still routes via Botanical Garden and omits the Aqua Line. Contradicts itself: airport 60 km vs 70 km; Pari Chowk auto ₹150–300 vs ₹50–150 |
| 6 | [careers360.com](https://www.careers360.com/question-is-bennett-unversity-good-should-i-go-there-will-there-be-any-risk-as-it-is-established-in-2016-like-teachers-leaving-the-institution-etc/amp) | Q&A | 295 | Q 30 Apr 2018; A 9 Jun 2018 | H1 = question, 2 answers; QAPage | Off-topic. Its phrase "near the proposed metro station" is where the "proposed" wording comes from |
| 7 | [hotels.com](https://ph.hotels.com/ho1139221152/oakwood-at-bennett-park-arlington-united-states-of-america) | OTA | Not fetched | n/o | n/o | A US hotel: an artifact of the US index |
| 8 | [careers360.com](https://www.careers360.com/question-where-is-maharaja-agrasen-college/amp) | Q&A | Not fetched | n/o | n/o | About an unrelated college (filler) |
| V2 | [kollegeapply.com](https://www.kollegeapply.com/college/bennett-university-greater-noida) | Admissions portal | 2,235 (the metro answer is a 40-word FAQ) | "Updated on 12 Aug, 2026" | H1 + 10 H2, 10 tables; Article, FAQPage, CollegeOrUniversity, AggregateRating | The only FAQPage that answers "nearest metro": Depot 8.5 km, Delta 1 9.7 km, Pari Chowk 11 km (unverified). No fares or route. The tool's answer summary quotes it |
| V6 | [universitykart.com](https://universitykart.com/university/universitydetails/bennett-university-greater-noida) | Admissions portal | 2,418 (278 on transport) | Schema 17/02/2026 (published 24/09/2021); title says 2025, H1 says 2026 | H1 + ~10 H2; 9 tables, incl. a mode / route / time table; Article, FAQPage | Prose says Noida City Centre is ~25 km away; its own table says take the Aqua Line to KP-II. Claims "40 km west of IGI" |
| R6 | [kcchostels.com](https://www.kcchostels.com/blog/hostel-near-bennett-university-techzone-2-greater-noida/) | PG-operator blog | 633 (630 in .entry-content) | Published 2021-12-03; never modified | No H1/H2 in the content; Article (Yoast) | Names Delta 1 as the nearest metro, then KP-II. Says "15 min from Pari Chowk" against the field check of 20–25 min |

Average of the top 5 = **808 words** (only 3 of 5 could be observed). The longest on-topic transport text is **824 words**. Across 7 observed pages there are **6 different "nearest metro" answers**.

### 2. restaurants near bennett university
In the US index, the plain query returned no Indian results: all 9 were US "Bennett" entities (Bennett CO, Bennett NC, Bennett College and others). The table below is for **"restaurants near bennett university greater noida"**.

| # | URL (domain) | Type | Words | Updated | Structure / schema | Issue |
|---|---|---|---|---|---|---|
| 1 | [expedia.co.in](https://www.expedia.co.in/Bennett-University-Hotels.0-l859897110099681280-0.Travel-Guide-Filter-Hotels) | OTA | n/o (429 bot check) | Title says "2025 Updated Prices" | n/o | Wrong intent (hotels) |
| 2 | [dominos.co.in](https://www.dominos.co.in/store-location/noida/bennett-university-campus-greater-noida-uttar-pradesh) | Official store locator | n/o (JS-rendered; the served HTML has 13 words) | n/o | No schema in the served HTML; empty meta description and canonical | The only exact-entity restaurant (on campus, N Block). The "nearby" restaurant names are unverified. PIN 201310 (Mappls shows 201312) |
| 3 | [goibibo.com](https://www.goibibo.com/hotels/hotels-in-greater-noida/near-bennett-university-lh/) | OTA | n/o (8-byte response / timeout) | n/o | n/o | Wrong intent (hotels) |
| 4 | [stanzaliving.com](https://www.stanzaliving.com/paying-guest-pg-hostel-near-bennett-university-delhi-eastern-peripheral-expressway-greater-noida-slw5e7ie5aeg) | PG operator | 7,097 (0 about restaurants) | No date | H1 + 14 H2; 25+ FAQs; FAQPage, ItemList, LocalBusiness, AggregateRating, Review | Wrong intent. Ranks on "Free Food". All 4 PGs are 9–9.4 km from Bennett |
| 5 | [tripadvisor.in](https://www.tripadvisor.in/Restaurants-g2140594-Greater_Noida_Gautam_Buddha_Nagar_District_Uttar_Pradesh.html) | Aggregator | 1,743 (mostly cards and filters) | "Updated 2026" in title; no dateModified | H1, 1 H2, filter H3s; 118 images; 5-Q FAQ; ItemList, Restaurant, AggregateRating, GeoCoordinates, OpeningHoursSpecification, FAQPage | City-level list. None of its 30 restaurants is in Tech Zone II. The top 10 is mostly 5-star hotel restaurants, and some entries have Noida PINs |
| 6 | [shiksha.com](https://www.shiksha.com/university/bennett-university-greater-noida-48472/infrastructure) | College portal | n/o (403) | n/o | n/o | The snippet claims "24/7 hygienic eating joints": unverified marketing copy |
| 7 | [justdial.com](https://www.justdial.com/Greater-Noida/Bennett-University-Near-Tech-Zone-II-Xu-3/011PXX11-XX11-160823091123-F7M4_BZDET) | Directory | n/o (403 / empty) | n/o | n/o | Lists the university itself (wrong intent) |
| 8 | [makemytrip.global](https://www.makemytrip.global/hotels-international/en-us/india/greater_noida-hotels/bennett_university.html) | OTA | n/o (timed out) | n/o | n/o | Wrong intent. "831 hotels near Bennett" is a programmatic figure |

**6 of 8 results serve the wrong intent** (hotels, PG, a university listing). The observed top 5 has effectively 0 words about eating near Bennett.

### 3. galgotias university nearest metro station

| # | URL (domain) | Type | Words | Updated | Structure / schema | Issue |
|---|---|---|---|---|---|---|
| 1 | [youtube.com](https://www.youtube.com/watch?v=H1UJfaZBjL4) | Video | n/a (4 min 48 s; 4,915 views) | 2022-08-27 | Exact-match title; page not parsed | Description is keyword-stuffed ("galgotias university gurgaon"). Claims in the video not verified. Points to video intent |
| 2 | [quora.com](https://www.quora.com/Which-is-the-nearest-metro-from-Galgotias-University) | Q&A | n/o (Cloudflare 403) | n/o | n/o | Could not be verified |
| 3 | [galgotiasuniversity.edu.in](https://www.galgotiasuniversity.edu.in/p/careers/contact-us) | Official | 340 | n/o (no date) | H1 + route H3s (IGI, NDLS, Ghaziabad); map pin 28.36734, 77.53745; CollegeOrUniversity, EducationalOrganization, ContactPoint, PostalAddress | Never mentions the Aqua Line. Route is DTC bus from ISBT → Pari Chowk → auto "around 50 INR" (verify: the similar ~11 km Bennett ride costs ₹150–200). The **only result with the correct location** |
| 4 | [collegego.co](https://collegego.co/colleges/galgotias-university-greater-noida) | Thin admissions portal | 471 (78 on the metro) | n/o ("Admissions 2026-27") | H2 "Nearby Metro Stations"; 1 table; 3-Q FAQPage; GeoCoordinates | **Wrong pin** (28.4571, 77.515), about 10.2 km from the official pin. That is why it says "Pari Chowk 1.0 km, 13 min walk"; the straight-line distance from the official pin is ≈11.0 km. This page is the source of the 1 km vs 13 km contradiction |
| 5 | [metrostation.co.in](https://www.metrostation.co.in/nearest-metro-stations/to/galgotia-university-map/) | Programmatic | n/o (timeout / ECONNREFUSED) | n/o | Programmatic URL pattern | Server down, yet still ranks |
| 6 | [metroxp.com](https://metroxp.com/nearest-metro-station-to-galgotias-university/) | Programmatic | 132 (Wayback 15 Dec 2025; live HTTP 500) | 2020-07-16 | H1, 2 H2, map; Article | Says "Knowlege Park II" is 13 km away. No fare or time. PIN 203201 |
| 7 | [travelatweb.com](https://travelatweb.com/galgotia-university-nearest-metro-station/) | Off-topic travel blog | 244 | 2024-07-01 | H1, 3 H2, 2 H3; directions map; Yoast WebPage (no Article) | KP-II ~13 km, 15–20 min, no fare. Metro hours 5:30 AM–11:30 PM with no source. "Galgotia" misspelled in title and H1 |
| 8 | [moovitapp.com](https://moovitapp.com/index/en/public_transit-Galgotia_College_of_Engineering_Technology_Galgotia_Col_of_Engg_Technology-Delhi-site_77473984-3801) | Programmatic transit | n/o (403 error page) | n/o | None | Wrong entity (GCET, labelled "Sikandarabad"). Dead URL |
| 9 | [travelatweb.com](https://travelatweb.com/tag/galgotia-university-nearest-metro-station/) | Tag archive | Not fetched | n/o | WP tag archive | The same thin domain holds 2 slots |
| 10 | [careers360.com](https://www.careers360.com/question-distance-between-okhlanew-delhi-to-galgotia-university-by-metro-and-what-is-fare) | Q&A | ~75 (the one answer) | Q 2019-06-26; A 2019-08-05 | QAPage | 7 years old. Okhla ~30 km, ₹60. No last-mile fare |

Average of the 3 observable pages in the top 5 non-video results ≈ **314 words**. Every text result is under 500 words. Straight-line distances from the official pin (OSM): KP-II 10.6 km, Noida Sec 148 10.8 km, Pari Chowk 11.0 km, Alpha 1 11.8 km, Depot 13.5 km. **No station is within walking distance.** The variant query ("… greater noida") returned Rome2rio (403), Collegedunia (about GCET), Wikipedia "Knowledge Park II" (362 words, modified 2025-07-09) and distancesfrom.in (now 404).

### 4. pg near bennett university

| # | URL (domain) | Type | Words | Updated | Structure / schema | Issue |
|---|---|---|---|---|---|---|
| 1 | [instagram.com](https://www.instagram.com/popular/pg-near-bennett-university/) | Social topic hub | 0 server-rendered (login wall) | n/o | None observed | Ranks on the exact string. Shows that PG owners advertise on Instagram |
| 2 | [stanzaliving.com](https://www.stanzaliving.com/paying-guest-pg-hostel-near-bennett-university-delhi-eastern-peripheral-expressway-greater-noida-slw5e7ie5aeg) | PG operator | 7,205 (~3,357 editorial + FAQ) | No page date; newest review dated 25 Sep 2026 | H1 + ~10 H2; 4 listing cards; 26-Q FAQ; 34 images; LocalBusiness, AggregateRating, Review, ItemList, FAQPage | All 4 "near Bennett" PGs are in Knowledge Park, 9–9.4 km away. Prices conflict: 8k in the title, ₹7,000 in the FAQ, ₹12,699–17,299 on the cards. Slug says "Eastern Peripheral Expressway" |
| 3 | [nobroker.in](https://www.nobroker.in/pg-near-bennett-university-greater-noida) | Aggregator | 1,438 | Listings dated 2026-02-28 to 2026-09-02 | H1; 12 H2s (the 6 listings, each twice); 3-Q FAQ; FAQPage, WebSite | Broken template ("Greater_noida"). 6 listings at ₹7,000–12,000. Food and gate-time fields mostly "Not Available" |
| 4 | [stanzaliving.com](https://www.stanzaliving.com/coliving-pg-paying-guest-for-working-professionals-near-bennett-university-delhi-eastern-peripheral-expressway-greater-noida-slw5e7ie5aeg) | PG operator | 7,572 | No page date | 1 table; same schema as #2 | Near-duplicate of #2 aimed at working professionals. Stanza takes 2 of the top 4 through a template |
| 5 | [en.wikipedia.org](https://en.wikipedia.org/wiki/Bennett_University) | Encyclopedia | 1,425 | 2026-09-01 | 6 H2, 4 tables; Article | Wrong intent: "hostel" appears 0 times. Its coordinates (28.45065, 77.58201) are useful as a reference pin |
| 6 | [radheygirlspg.in](https://radheygirlspg.in/) | Single PG | 522 | n/o | H1, H2s, price H3s, map (Xu-3); no JSON-LD | Self-reported rent ₹7,500–16,000. "Just beside Bennett" with no distance. No deposit or in-time info. Ranks with no schema at all |
| 7 | [nestnear.in](https://www.nestnear.in/university/bennett-university) | Thin template | 141 | n/o | CollectionPage, ItemList, EducationalOrganization | Claims "20+ listings" but shows 0. Calls Dankaur (11.6 km) and Alpha 1 (7.1 km) "walking distance" |
| 8 | [choudharypg.com](https://www.choudharypg.com/) | Single PG | n/o (DNS doesn't resolve) | n/o | n/o | Dead domain that still ranks. Also a navigational brand query |
| 9 | [careers360.com](https://www.careers360.com/question-any-pgs-near-bennett-universitygreater-noida-delhi/amp) | Q&A | ~42 (the one answer) | Q 2018-11-13; A 2018-12-23 | QAPage | 8 years old. Points to one PG in Beta 2 (not near Bennett). No prices |
| V8 | [greaternoidag.in](https://greaternoidag.in/also-listed/pg-near-bennett-university/) | Directory tag page | 335 | Every listing says "1 year ago" | CollectionPage, BreadcrumbList | None of its 10 listings is in Xu-3 or Tech Zone II. ₹5,500–7,500. Irrelevant sidebar businesses. (zokr.in at V9, 142 words, has the same pattern) |

Average of the 4 observable top-5 pages ≈ **4,410 words**, inflated by listing cards and reviews. Real PG-specific text is short: 141 (NestNear), 335 (greaternoidag), 522 (Radhey), ~42 (careers360 answer).

### 5. is greater noida safe for students

| # | URL (domain) | Type | Words | Updated | Structure / schema | Issue |
|---|---|---|---|---|---|---|
| 1 | [youtube.com](https://www.youtube.com/watch?v=H-xoUzAJmhE) | Video | n/a (15:06; 6,676 views) | 2024-07-08 | Talking head; no chapters | Low view count yet #1, meaning few better documents exist. Claims not checked |
| 2 | [quora.com](https://www.quora.com/What-are-some-safe-areas-to-live-in-Noida-and-or-Greater-Noida-for-students-doing-their-8th-semester-internship) | Q&A | ~3,916 rendered (incl. related answers and ads) | AI-bot answer ~1 yr old; human answers 9–11 yrs old | Q&A thread; no schema observed | The top AI-bot answer wrongly puts KP I–III in Greater Noida West. Human answers predate the Aqua Line |
| 3 | [en.wikipedia.org](https://en.wikipedia.org/wiki/Delhi_Public_School,_Greater_Noida) | Encyclopedia | 872 | 2026-09-17 | 7 H2; Article | Irrelevant (a school) |
| 4 | [greaternoidatoday.com](https://greaternoidatoday.com/is-greater-noida-safe-for-students/) | Niche local blog | 1,984 | Published = modified = 2025-02-27 | H1, 7 H2, 20 H3; 5 lists; 1 image; no FAQ/table; BlogPosting, Person, NewsMediaOrganization | Generic, AI-sounding text. "Metro till around 10 PM" unverified. Lists 1091 but not UP's 1090 (verify). No area-level advice |
| 5 | [greaternoidatoday.com](https://greaternoidatoday.com/is-greater-noida-safe/) | Niche local blog | 1,629 | 2025-01-31 (a second JSON-LD node says 2025-02-21) | 8 question H2s but **no FAQPage**; BlogPosting | Unsourced claims (e.g. "500 electric buses"). No times or data. The student section is ~200 generic words |
| 6 | [en.wikipedia.org](https://en.wikipedia.org/wiki/Army_Institute_of_Management_and_Technology,_Greater_Noida) | Encyclopedia | 740 | 2026-08-07 | 6 H2; Article | Irrelevant (a college) |
| 7 | [kcchostels.com](https://www.kcchostels.com/blog/is-greater-noida-safe-at-night/) | PG-operator blog | 693 (678 in .entry-content) | 2023-07-06 | H1, no H2, 2 H3; no images; Article, Person "admin" | Lists "Noida sectors" as safe areas of Greater Noida. Unsourced "crime declining". About 40% is a hostel pitch |
| 8 | [tribuneindia.com](https://www.tribuneindia.com/2007/20070927/delhi.htm) | News | ~440 (the relevant story) | 27 Sep 2007 | Legacy table layout; no schema | 19 years old; predates the metro and the police commissionerate |

Average of the top 5 non-video results ≈ **1,828 words** (Quora's count is inflated). The on-topic articles (greaternoidatoday ×2 + KCC) average ≈ **1,435 words**. The freshest on-topic page is from Feb 2025. A careers360 Q&A (2020-11-07, ~70-word answer) sits at #9.

### 6. auto fare in greater noida

| # | URL (domain) | Type | Words | Updated | Structure / schema | Issue |
|---|---|---|---|---|---|---|
| 1 | [cabbazar.com](https://cabbazar.com/taxi/cab/greater-noida-to-noida) | Cab aggregator | 2,188 | n/o | H1, 15 templated H2, 1 fare table, FAQ; FAQPage, Product, AggregateOffer, AggregateRating, TaxiService | Wrong intent (intercity cab). Sedan ₹165 vs Innova ₹1,225 on the same page |
| 2 | [cabbazar.com](https://cabbazar.com/taxi/cab/noida-to-greater-noida) | Cab aggregator | 2,233 | n/o | Same template as #1 | Factual errors: Greater Noida "also known as Gautam Buddha Nagar"; "west extension of Noida" |
| 3 | [makemytrip.com](https://www.makemytrip.com/car-rental/noida-greater_noida-cab-services.html) | Cab aggregator | ~5,988 rendered (mostly widgets) | n/o | 11 tables, 53 images; Product, AggregateRating, FAQPage, SpeakableSpecification | Template bug: "around Km [blank] … 4 hrs". Title ₹1,041 in the index vs ₹1,251 live |
| 4 | [solocabs.com](https://www.solocabs.com/greater-noida) | Cab aggregator | ~1,648 | n/o | 1 table, 1-Q FAQ; FAQPage, TaxiService | Outstation packages only. Mislabelled link lists |
| 5 | [taxiautofare.com](https://www.taxiautofare.com/taxi-fare/Delhi-taxi-fare-from-new-delhi-railway-station-to-greater-noida) | Calculator | ~470 | n/o | H1, 3 H2, 1 table; Organization, Offer | H1 says ₹330, body says ₹352. "Ola auto" night fare is lower than day. Covers Delhi → GN taxi, not local autos |
| 6 | [rapido.bike](https://rapido.bike/delhi/routes/Noida-Greater_Noida) | Official app | 357 (static) | n/o | Empty `<title>`, H1 "Delhi"; fares only inside a JS iframe (auto ₹353–432, Noida → GN); no schema | City-to-city estimate. Fares barely indexable. Nothing within Greater Noida |
| 7 | [blablacar.in](https://www.blablacar.in/ride-sharing/greater-noida) | Carpool | 0 static; ~750 rendered (generic) | n/o | Organization, Service | The URL now redirects to the homepage (stale index entry) |
| 8 | [taxiautofare.com](https://www.taxiautofare.com/taxi-fare-card/Noida-Auto-fare) | Calculator | ~709 | Last checked 01-Nov-2025; updated 06-Jan-2026 | 4 tables; TaxiService, PriceSpecification | Wrong city (Noida). Official meter tariff of ₹25 per 2 km + ₹8/km gives **₹97 for 11 km**; the street price on the field check is ₹150–200 |

Average of the top 5 ≈ **2,505 words**, nearly all boilerplate. **Zero words** about local auto or e-rickshaw fares within Greater Noida. The related query "pari chowk to bennett university auto fare" returns only the 2017–18 conference pages quoting ₹50–150.

---

### Cross-keyword findings

**Ranking factors observed**

| Factor | Evidence | Implication for us |
|---|---|---|
| Exact-match phrase in title / H1 / URL | Every Galgotias text result has the phrase in its title. icmlds ranks with 236 words on "How to Reach Bennett University". Hotel and PG pages rank for "restaurants" because they contain "near Bennett University". The PG winners use the slug `pg-near-bennett-university` | Start the title, H1 and slug with the exact keyword |
| Aggregator / domain authority | Tripadvisor, Wikipedia (3 irrelevant slots), careers360 (5 slots), OTAs, cabbazar, MakeMyTrip | We can't win on authority, so win on relevance and accuracy |
| FAQ / list schema on aggregators | FAQPage on kollegeapply, collegewollege, universitykart, collegego, Stanza, NoBroker, Tripadvisor, cabbazar, MakeMyTrip. Search answer summaries quoted the FAQ answers from kollegeapply and collegego | Put an answer-first paragraph and an FAQ block under each topic; answer engines lift them |
| Video and UGC | YouTube is #1 for 2 of 6 keywords (Galgotias metro, safety). Q&A or social results (Quora, careers360, Instagram) appear in 4 of 6 SERPs | A short route video plus genuine forum answers add SERP real estate |
| Entity disambiguation | US Bennett entities swamp the plain restaurants query. Galgotias University and GCET get mixed up (Moovit, CollegeGo's pin, Wikipedia KP-II). Noida gets mixed up with Greater Noida (fare card, KCC safety post) | Put "Greater Noida" in title and H1; add disambiguation callouts |
| **Not rewarded: accuracy and freshness** | 6 ranking URLs were dead, erroring or redirecting on 26 Sep 2026: ictiee (500), metroxp (500), metrostation.co.in (unreachable), Moovit GCET (error page), choudharypg.com (DNS), BlaBlaCar (redirects to the homepage) | No accurate page competes yet, so the first correct, dated page has open room |

**Content length benchmarks**

| Keyword | Observed top-5 average | Longest on-topic text | Our target |
|---|---|---|---|
| bennett university nearest metro station | 808 (3 of 5 observed) | 824 (collegewollege); the winning answer is a 40-word FAQ | 1,200–1,800 |
| restaurants near bennett university | Can't compute (2 of 5 observed) | ~0 about food near Bennett; Tripadvisor 1,743 (city-wide) | 1,500–2,000 |
| galgotias university nearest metro station | ~314 (3 observed) | 471 (collegego, of which 78 on the metro) | 1,200–1,800 |
| pg near bennett university | ~4,410 (4 observed, inflated by cards and reviews) | Stanza editorial ~3,357; single-PG text 141–522 | 1,800–2,500 |
| is greater noida safe for students | ~1,828 | 1,984 (greaternoidatoday) | 1,800–2,200 |
| auto fare in greater noida | ~2,505 (boilerplate) | 0 about local autos | 1,200–1,600 + route table |

Length is not what ranks here. The bar is to answer first, be correct, and date every fact.

**Freshness and accuracy problems**

| Problem | Evidence |
|---|---|
| Outdated routes | ictiee, icmlds and collegewollege all route via Botanical Garden + UPSRTC bus and omit the Aqua Line (open since Jan 2019). The Galgotias official page routes via an ISBT DTC bus |
| Conflicting "nearest metro" answers | Bennett gets 6 answers from 7 pages: Botanical Garden, "proposed", Depot 8.5 km, Delta 1, KP-II, Noida City Centre ~25 km. For Galgotias, CollegeGo says Pari Chowk is 1.0 km; the official pin puts it ~11.0 km away (straight line) |
| Fare drift | Pari Chowk → Bennett is quoted at ₹50–150 (2017–18 pages), ₹150–300 (collegewollege) and ₹97 (Noida meter card). The field check is ₹150–200 |
| Last-metro time | "Around 10 PM" (greaternoidatoday), 5:30 AM–11:30 PM with no source (travelatweb), 10:08–11:45 pm in other SERPs. Nothing is cited to NMRC |
| PIN codes | Bennett: 201310 / 201312 / 203202. KCC's own contact page gives both 201310 and 201306 for KP-III |
| Stale dates | On-topic pages date from 2007 (Tribune), 2017–18 (conference pages, careers360), 2020 (metroxp), 2021 (KCC) and 2023 (KCC safety). The newest safety page is Feb 2025. No page shows a "last checked" date on its facts |
| Date or badge theatre | collegewollege shows three different dates plus a "Fact-Checked" badge while contradicting itself |

**SERP features (not directly observable)**

| Keyword | Indirect signal (US index) | To confirm on google.co.in |
|---|---|---|
| Bennett metro | Search answer summaries quoted the 2018 Botanical Garden route and kollegeapply's FAQ | Featured snippet, PAA, AI Overview source |
| Restaurants near Bennett | "Near" + commercial query | Maps local pack (very likely); which organic result sits under it |
| Galgotias metro | YouTube #1; Quora and careers360 rank | Video carousel, PAA |
| PG near Bennett | Instagram #1; listing-heavy SERP | Local pack, Discussions & forums |
| Safety | YouTube #1; Quora, Tripadvisor and careers360 threads | Video block, Discussions & forums, Reddit |
| Auto fare | 7 of 8 are cab or carpool pages (the index reads "auto" as automobile) | App/brand results (Rapido, Uber, Ola), local pack for "auto stand" |

**Question keywords worth an H2 or FAQ** (autocomplete, used as a PAA proxy)

| Page | Question H2s | FAQ / Hinglish |
|---|---|---|
| Bennett metro | Which metro station is nearest to Bennett University? · How far is Bennett from Pari Chowk? · How to reach Bennett by metro from Delhi? | "Bennett University Pari Chowk se kitni dur hai?" · Bennett shuttle service · bus route timings · nearest railway station · Ghaziabad RS |
| Food near Bennett | Best restaurants near Bennett · Cafés near Bennett · Dhaba near Bennett | Mess timings / menu / fees · Domino's on campus · food court · restaurants near Pari Chowk |
| Galgotias metro | Which metro station is near Galgotias? · How to reach from Botanical Garden / Pari Chowk / Delhi · How far is KP-II? | "Galgotias University Pari Chowk se kitni dur hai?" · Galgotias vs GCET · college bus timings · nearest railway station |
| PG near Bennett | How much is a PG near Bennett? · Best PG near Bennett · PG vs Bennett hostel | Is the hostel compulsory? · girls PG · PG with food · single room · reddit |
| Safety | Is Greater Noida safe for girls / at night? · Safest areas for students | Is Pari Chowk safe? · Is Bennett / Galgotias safe for girls? · safe to live? · reddit (leave out "safe for muslims" unless there is first-hand, non-generalising input) |
| Auto fare | Pari Chowk to Bennett auto fare · KP-2 to Galgotias auto fare · Botanical Garden to Pari Chowk auto fare | Is Uber / Rapido available in Greater Noida? · Rapido timings · night fare. Exclude vehicle-purchase queries such as "auto price in greater noida" |

> **Correction for KEYWORDS.md (row #1):** the 2017–18 conference pages do not call the Aqua Line "proposed". They leave it out and route via Botanical Garden + bus. The word "proposed" comes from a 2018 careers360 answer. Reword this before submission.

### Ranking opportunities

| Keyword | Why winnable | Our format | Target length | Snippet / FAQ angle |
|---|---|---|---|---|
| bennett university nearest metro station | No dedicated or current page. #1 is a 2018 page returning HTTP 500. 6 conflicting answers. The de facto answer is a 40-word FAQ | Guide with a station comparison table: `/getting-here/bennett-university-nearest-metro-station/` | 1,200–1,800 | 40–50-word answer (Pari Chowk, ~11 km, 20–25 min, auto ₹150–200, Uber/Rapido steadier, ≤ ₹200). Table: station / line / road km / time / fare / last checked. `<ol>` for the Delhi → Bennett route. Hinglish H3. A "Why other sites say Botanical Garden" box |
| restaurants near bennett university | 6 of 8 results are the wrong intent; ~0 on-topic words; US-entity collision | List + master table at `/eat/food-near-bennett-university/`, with "Greater Noida" in the title and H1 | 1,500–2,000 | `<ol>` of 8–12 places (list snippet). Table: place / area / km from gate / fare / price for two / veg / open till / delivers to gate / last checked. FAQ on mess and delivery |
| galgotias university nearest metro station | All text results are under 500 words; 3 top-8 URLs are dead or erroring; CollegeGo is ~10 km off; no authority barrier | Guide at `/getting-here/nearest-metro-station-galgotias-sharda-gl-bajaj/` with the title starting with the exact phrase; include a GCET disambiguation box | 1,200–1,800 | Open with "No metro within walking distance", then a Pari Chowk vs KP-II table (road km, shared and reserved auto, Rapido/Uber, last checked). A route Short with VideoObject to compete for the video slot. **Field check needed; don't reuse the Bennett figures** |
| pg near bennett university | The top 10 is operator templates, broken aggregators, a dead domain and a 2018 Q&A. The "near" PGs are 9+ km away | Independent comparison guide at `/stay/pg-near-bennett-university/` | 1,800–2,500 | Rent-range answer from our own survey. Table of 10+ PGs: pocket / km to gate / sharing / AC / food / rent / deposit / electricity / in-time / last checked. H2s for PG vs hostel and girls PG. Commute-cost maths for KP PGs |
| is greater noida safe for students | The on-topic pages are generic (2025) and a 2023 KCC pitch; 3 slots are filler (2 Wikipedia pages, a 2007 news page) | First-hand guide at `/living/is-greater-noida-safe-for-students/` | 1,800–2,200 | 40–55-word direct answer. Area day/night table. "Safest areas" list. Last-metro time dated and cited to NMRC. Helplines verified. A small anonymous student survey |
| auto fare in greater noida | Zero local fare content. The only auto card is Noida's meter tariff | Data hub at `/getting-here/` with a route fare table (HTML, not an image) | 1,200–1,600 + table | First 50 words give the Pari Chowk → Bennett ₹150–200 answer. Routes table (shared e-rickshaw / reserved auto / Rapido-Uber quote / night and holiday). "Meter tariff vs street price" box. Uber/Rapido availability FAQ |

Shared schema plan for all six pages: Article/BlogPosting with a named Person author (a student, with a bio), datePublished and dateModified, and BreadcrumbList. Add FAQPage for machine-readability only: since 2023 Google shows FAQ rich results mainly for authoritative government and health sites. Use ItemList where the page is a list. **No** HowTo (deprecated), Product/Offer, or self-serving AggregateRating.

---

## Competitor Analysis & Content Gap

### Why these two competitors

| Competitor | Selection evidence (US-index web search, 26 Sep 2026) |
|---|---|
| **A. kcchostels.com** (blog at /blog/) | The only domain found on **both** our safety/living cluster and our stay cluster: #7 for safety, #6 for hostel near Bennett, #8 for PG near Galgotias, #9 for how to find PG, #7 for PG at Pari Chowk, #4–6 for girls PG near KP-2 (3 of 9 results), #7 for cost of living. Its Bennett page already feeds answer text ("nearest metro station being Knowledge Park II") for a related query |
| **B. uniliv.in** | The only editorial, non-directory domain across several of our clusters: #4 cafés near Knowledge Park, #3 cost of living in Greater Noida for students, #7 colleges in KP-3, #2 student life in Knowledge Park, #5 "is Knowledge Park good for students". It was also recorded in the earlier clusters.json SERPs for cafés, colleges and cost of living |

Both target our audience (freshers, PG hunters, parents) with /stay/, /eat/ and /living/ topics. Stanza Living and NoBroker also rank on the PG SERPs, but they are listing or operator platforms.

### Side-by-side comparison

| Dimension | A. kcchostels.com | B. uniliv.in |
|---|---|---|
| What it is | Hostel / PG / co-living operator on the KCC Institutes campus (KP-III). A WordPress blog provides lead generation plus admissions content for its sister institutes | Delhi-based managed-PG / co-living company (founded 2022 per Tracxn/Inc42 snippets, unverified). Runs 2 Greater Noida PGs in KP-3: Olive (boys) from ₹16,000 and Mangrove (girls) at ₹21,000 or ₹22,000 (the site contradicts itself) |
| Scope | 702–703 posts, 93 categories, 1,902 tag URLs. ~291 local-living slugs, including 31 "hostel-near-<college>" pages | 309 posts, of which **7 are about Greater Noida (~2%)**, plus 3 money pages. Mostly Delhi, other cities and generic student-life posts |
| Freshness | 286 posts in 2021, 22 in 2024, 23 so far in 2026. Only 1 pre-2025 post has been modified since 2025, so the local content is frozen at 2021–24 | 175 posts in the last 12 months, in bursts (105 in Jan–Mar 2026, 0 in Aug). KP posts are from Jan 2026 (3 modified 28 Mar 2026), plus 14 Jul and 17 Sep 2026 |
| Content quality (sampled) | Safety 678, Bennett 630, KP-II metro 348, cafés 344, Galgotias girls PG 2,076, cost 1,360 words. Contradictions: Bennett nearest metro is Delta 1 and also KP-II; cost ₹25–35k vs ₹6–8k vs ₹8–12k. Spun text ("we at your space"). "PG hostel near me" repeated 8 times | 800–1,276 words each. No photos, addresses, prices or citations. 3 of its 7 "cafés" are generic types. Its two cost posts contradict each other (electricity included vs prepaid meter; ₹12.5–18k vs ₹15–30k). Puts NIET in KP-3 and Galgotias/GBU in Knowledge Park. Keyword density 3.5–6.8% |
| E-E-A-T | All 702 posts by "admin". No bio, no sources, no "last checked". 4 of 5 core samples have 0 content images | 283 posts under the "Uniliv" org account and 26 under Tanishka Jaswal (the only named author, with a LinkedIn sameAs). First-person claims under the org byline. No photos or citations |
| Technical | Main site (static Apache): no canonical, 5 H1s, www and non-www both return 200, no XML sitemap, no link to the blog. Blog (WP 7.1.2 + Elementor + Yoast): 5 of 9 sampled posts have no meta description; 1,902 indexable tag archives; near-duplicate posts. One TTFB test ≈ 1.2 s (not a CWV measurement) | Clean 301s and self-referencing canonicals. Two sitemaps; noindexed archives still listed in wp-sitemap. `lang="en-US"`. Easy TOC. `/llms.txt`; robots.txt allows the major AI-search crawlers |
| Schema | Yoast defaults (Article, WebPage, BreadcrumbList, Person "admin"). No FAQPage despite FAQ sections. No LocalBusiness | SASWP (WebPage, Article, BreadcrumbList). FAQPage on 2 of 7 posts. Homepage LodgingBusiness with a self-serving AggregateRating (4.5 from 2,100 reviews). Property pages lack LodgingBusiness, Offer and geo markup |
| Internal linking | The same 4 templated "Important Links" on many posts; some posts have 0–1 links | 0–2 in-body links per post. None of the 7 Greater Noida posts links to the KP-3 property pages |
| Commercial bias | Every local post ends in a KCC pitch or phone CTA. Implausible distance claims (0.5 km to Galgotias University; 15 min to Bennett) | Every post steers readers to managed PGs. Quotes a market rate of ₹7–9k for shared rooms while its own KP-3 PGs start at ₹16k (not disclosed). Claims KP-3 is "next to" Bennett and Galgotias |
| Backlinks (observable) | Few independent mentions. Signals: Facebook, Justdial, portal hostel pages (about KCCITM), a Quora thread, sister-site links (kccitm.edu.in, jimsgn.org), an agency footer link, a "Write for Us" page | Social profiles; Tracxn, Inc42 and invstt; Delhi listings (houssed, cofynd); an issuu document; a riverworksart.org forum post (404 when fetched). No press or university mentions, and nothing for the Greater Noida properties |
| Backlink metrics (DR, referring domains, anchors) | **See Ahrefs / Semrush screenshot** | **See Ahrefs / Semrush screenshot** |
| Gaps in their visibility | Transport and fare posts don't rank. Not in the top 9 for Bennett nearest metro (re-check on .co.in) | No transport, safety, pin-code or late-night food content. Not in the top 10 for any PG query, including its own property pages |

### Their overlapping keywords

| Keyword | Competitor | Their URL | Position (US index, 26 Sep 2026) | Our page |
|---|---|---|---|---|
| is greater noida safe for students | KCC | https://www.kcchostels.com/blog/is-greater-noida-safe-at-night/ | #7 of 9 | /living/is-greater-noida-safe-for-students/ (#10) |
| is greater noida safe at night | KCC | same URL | #7 of 8 | H2 on the safety page |
| bennett university nearest metro station | KCC | https://www.kcchostels.com/blog/hostel-near-bennett-university-techzone-2-greater-noida/ | Not in top 9 (re-check .co.in); #5 for "bennett university metro station knowledge park 2 hostel" | /getting-here/bennett-university-nearest-metro-station/ (#1) |
| hostel near bennett university greater noida | KCC | same URL | #6 of 9 | /stay/pg-near-bennett-university/ (#7) |
| pg near galgotias university | KCC | https://www.kcchostels.com/blog/girls-pg-near-galgotias-university/ | #8 of 9 | /stay/pg-near-galgotias-university/ (#8) |
| how to find pg in greater noida | KCC | https://www.kcchostels.com/blog/list-of-pg-in-greater-noida/ | #9 of 9 | /stay/how-to-find-pg-greater-noida/ (#9) |
| pg in greater noida pari chowk | KCC | https://www.kcchostels.com/blog/pg-in-greater-noida-pari-chowk/ | #7 of 9 | /stay/ hub |
| girls pg near knowledge park 2 metro station | KCC | https://www.kcchostels.com/blog/girls-pg-near-knowledge-park-2-metro-station/ (+ tag archive, + /girls-hostel-near-knowledge-park-2-metro-station/) | #4, #5, #6 | /stay/ long tail |
| is greater noida expensive to live for students | KCC | https://www.kcchostels.com/blog/is-greater-noida-expensive-to-live/ | #7 of 9 | Cost-of-living page |
| cafe near knowledge park greater noida | Uniliv | https://uniliv.in/blog/cafes-near-knowledge-park-3/ | #4 | /eat/cafes-near-knowledge-park/ (#13) |
| cost of living in greater noida for students | Uniliv | https://uniliv.in/blog/cost-of-living-in-knowledge-park-greater-noida/ (+ /blog/cost-of-living-in-greater-noida/) | #3 | Cost-of-living page |
| colleges in knowledge park 3 greater noida | Uniliv | https://uniliv.in/blog/colleges-in-knowledge-park-3/ | #7 | Colleges page (/living/) |
| student life in knowledge park greater noida | Uniliv | https://uniliv.in/blog/colleges-in-knowledge-park-3/ (its dedicated post doesn't rank, a sign of cannibalization) | #2 | Home / student hub |
| is knowledge park greater noida good for students | Uniliv | same colleges URL (its review post doesn't rank) | #5 | Home / student hub |
| Targeted but not ranking | KCC | KP-2 metro, Aqua Line route and fare, best cafés, things to do, PG in KP-3 (2021 posts, 265–348 words) | Not in top 9–10 | /getting-here/, /eat/, /explore/ |
| Targeted but not ranking | Uniliv | /blog/pg-in-greater-noida-without-brokerage/, /greater-noida/ (69 words), KP-3 boys/girls PG pages, Bennett claims on property pages | Not in top 9–10 | /stay/ pages |

### Content gap matrix

| Topic | A. KCC | B. Uniliv | knowledgeparkguide.in plan |
|---|---|---|---|
| Bennett nearest metro + Pari Chowk fare | Contradictory (Delta 1 vs KP-II); "15 min" | None | Dated station table; field data (~11 km, 20–25 min, ₹150–200, Uber/Rapido, ≤ ₹200, holiday surge); correction box |
| Galgotias nearest metro | Places Galgotias University in KP-3, "0.5 km" away | Places Galgotias in Knowledge Park | Official pin, road distances for Pari Chowk vs KP-II, GCET disambiguation (after field check) |
| Auto / e-rickshaw fares | 2021 "best way to travel" post: no table, doesn't rank | None | /getting-here/ route fare table: shared vs reserved, day vs night, holiday surge, ceiling, last checked |
| Metro practicalities | 265–348 words (2021); incomplete station list; no timings | None | Last metro cited to NMRC, fares, exits, WhatsApp/QR tickets (#5), Pari Chowk → Botanical Garden bus (#6) |
| Safety | 678 words (2023); no data; ~40% pitch | None | Area day/night table, verified helplines, survey, night-return plan, girls' checklist |
| PG near Bennett | Promotes the KP-III property (~80% of the page) | Claims KP-3 PGs are "next to" Bennett | Xu-3 / Omicron / TechZone II pockets, rent table of 10+ PGs, commute-cost maths |
| Finding and comparing PGs | Lists only its own room types; 728-word how-to whose links all go to the KCC sales page | 800-word post of 6 generic steps; not ranking | Independent multi-PG table, scam / red-flag checklist, "no PG paid to be listed" |
| Cost of living | Contradictory; mixes in Noida sector rents | Two contradictory posts (#3) | One itemised, receipt-backed monthly budget for Greater Noida only, with last-checked dates |
| Cafés near Knowledge Park | 344 words for 10 cafés (2021); doesn't rank | #4; no addresses or prices; 3 generic entries; ignores "Cafe Knowledge Park" | 10–15 named cafés: distance from KP-II, price for two, hours, Wi-Fi note, own photos |
| Food near Bennett / late night / delivery | None observed | None | /eat/food-near-bennett-university/ and /eat/late-night-food-greater-noida/ |
| Colleges directory | n/o | #7; NIET misplaced; Sharda, Amity and Dronacharya missing | College → sector → gate → nearest station → road km → official link |
| Pin codes and sectors | Own contact page gives 201310 and 201306 | None | /living/knowledge-park-sectors-pin-codes/, citing India Post |
| Authorship and freshness | "admin"; frozen 2021–24 | Org byline; no updated date shown | Named student author with bio, own photos, visible "Last checked" on every table |

### Prioritized opportunities

1. **Publish the Bennett nearest-metro page first.** The field data is in hand, 6 answers conflict, and #1 is a dead 2018 page. Being correct beats KCC's contradictory page, which the answer engine already quotes. Measure the Depot and Delta 1 road distances before quoting them.
2. **Make /getting-here/ the only Greater Noida auto-fare table on the web.** Seed it with the Pari Chowk → Bennett row and add routes as field data arrives (items 4–5 are still pending). Neither competitor has anything comparable.
3. **Take the safety SERP.** KCC's 2023 page sits at #7 and greaternoidatoday's two pages are from 2025. Win with a survey, area-level night guidance, a dated last-metro time and verified helplines.
4. **Beat KCC and Uniliv on PG trust, not volume.** Build an independent rent table for 10+ PGs with distance to the gate and a disclosure line. Don't create a page per college without distinct data (KCC's 31-page doorway pattern).
5. **Take Uniliv's #3 cost-of-living slot** with one consistent, receipt-backed budget. Their two posts contradict each other.
6. **Take Uniliv's #4 café slot** with 10–15 named, located, priced cafés, including "Cafe Knowledge Park".
7. **Fix the geography nobody else gets right.** A colleges table and a pin-code table: NIET is in KP-II, and Galgotias (Sector 17A) and Bennett (Tech Zone II) are "around", not in, Knowledge Park.
8. **Set a technical and E-E-A-T baseline** that beats both competitors: one canonical host, an XML sitemap in Search Console, no indexable tag archives, a unique meta description per page, a clean H2/H3 outline, Article + Person + BreadcrumbList, no self-serving AggregateRating, 3–5 contextual hub-and-spoke links per page, AI crawlers not blocked, and a 2–3 sentence answer under each H2.
9. **Off-page:** helpful answers on the careers360 and Quora threads that rank, Reddit and Bennett club channels (within each forum's rules), and an Instagram reel for "PG near Bennett University". Offer the fare table and cost data as citable assets. Avoid "Write for Us" link schemes.
10. **Leave KCC its brand and commercial terms** ("hostel in greater noida", "kcc hostel"). Win the informational queries where its pages are thin, old and biased, then capture PG hunters further down the funnel.

Field checks still needed before publishing: Depot and Delta 1 road distances to the Bennett gate; Galgotias fares and road distances; the last-metro time from NMRC; helpline numbers from UP Police / 112; what field item 3 ("No") refers to (the evidence suggests it answers whether Bennett runs a metro shuttle, which needs confirming); field items 4 and 5 (pending).

### Screenshots to add (checklist)

- [ ] **google.co.in, incognito, location India:** the 6 analysed keywords (featured snippet, PAA, local pack, video, AI Overview, Discussions & forums)
- [ ] **google.co.in:** the 9 KCC overlap keywords and 5 Uniliv overlap keywords (actual Indian positions)
- [ ] **google.co.in `site:` checks:** `site:kcchostels.com/blog`, `site:kcchostels.com/blog/tag` (tag bloat), `site:uniliv.in "knowledge park"`, `uniliv -site:uniliv.in` (brand mentions)
- [ ] **Ahrefs Website Authority Checker:** DR for kcchostels.com, uniliv.in and greaternoidatoday.com
- [ ] **Ahrefs Backlink Checker (domain mode):** kcchostels.com and uniliv.in (DR, backlinks, linking websites, top backlinks)
- [ ] **Ahrefs Backlink Checker (exact URL):** KCC safety post, KCC Bennett post, Uniliv cafés post, Uniliv cost-of-living (KP) post (UR, backlinks)
- [ ] **Ahrefs SERP Checker (India):** "is greater noida safe for students" and "bennett university nearest metro station" (top 10 with DR/UR, KD, KCC's row)
- [ ] **Ahrefs Keyword Difficulty (India):** cafe near knowledge park, cost of living in greater noida, colleges in knowledge park 3, pg in knowledge park greater noida
- [ ] **Ahrefs Website Traffic Checker (India):** uniliv.in top pages and keywords
- [ ] **Semrush Domain Overview (database India):** both domains (Authority Score, organic traffic, keywords, backlinks, referring domains, top organic keywords)
- [ ] **Semrush Organic Research → Positions (India):** KCC filtered to URL contains `/blog/`, then keywords containing safe / bennett / metro / galgotias; Uniliv filtered to "knowledge park" and "greater noida"
- [ ] **Semrush Organic Research → Pages (India):** both domains, URL contains `/blog/`
- [ ] **Semrush Backlink Analytics:** both domains (referring domains, follow vs nofollow, anchors, new/lost)
- [ ] **Moz Link Explorer:** uniliv.in (DA, linking root domains) as a second opinion
- [ ] **Google Maps:** "Uniliv Olive Greater Noida" and "Uniliv Mangrove Greater Noida" (Business Profile rating and count vs the schema claim of 4.5 from 2,100)
- [ ] **Rich Results Test:** the KCC safety post, the Uniliv colleges post and the uniliv.in homepage (detected schema types)
- [ ] **PageSpeed Insights (mobile):** the KCC safety post and the Uniliv cafés post (Core Web Vitals, performance score)
