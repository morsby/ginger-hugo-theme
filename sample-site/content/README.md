---
date: "2017-03-20T13:37:23+01:00"
title: "Readme"
type: "readme"
---

# GingerDolls v 2.0

Hjemmesiden er nu kodet helt om og bygget på det system, der hedder Hugo. 

Hugo er det, man kalder en "static site generator". Det betyder, at Hugo tager et tema og noget indhold og slår det sammen til en færdig hjemmeside. Det gør det nemt at adskille indhold fra udseende. Derudover betyder det også, at du nu kan skrive selve tekst-delen af indholdet i det "kodesprog", der hedder Markdown. 

Desværre betyder det også, at der er en del nye ting for dig at forholde dig til. Her kommer dette dokument ind. Målet med dette er dels at forklare dig, hvad der er sket, og hvad det betyder for dig og dels at komme med alle de kodestumper, du skal bruge til nyt indhold.

Her er en indholdsfortegnelse:

<!-- TOC depthFrom:1 depthTo:6 withLinks:1 updateOnSave:0 orderedList:0 -->

- [GingerDolls v 2.0](#gingerdolls-v-20)
	- [Mappestruktur](#mappestruktur)
		- [`content/`](#content)
		- [`static/`](#static)
		- [De to mindre vigtige mapper, `public/` og `themes/`](#de-to-mindre-vigtige-mapper-public-og-themes)
	- [At tilføje/redigere indhold](#at-tilfjeredigere-indhold)
		- [Indhold-filens anatomi](#indhold-filens-anatomi)
		- [Markdown](#markdown)
			- [Afsnit](#afsnit)
				- [Enkelte linjeskift](#enkelte-linjeskift)
			- [Overskrifter](#overskrifter)
			- [Fed, skrå, gennemstreget skrift](#fed-skr-gennemstreget-skrift)
			- [Vandrette streger til inddeling](#vandrette-streger-til-inddeling)
			- [Links og enkle billeder](#links-og-enkle-billeder)
				- [Links](#links)
				- [Billeder](#billeder)
		- [Kodestumper til dit indhold](#kodestumper-til-dit-indhold)
			- [Billeder](#billeder)
				- [Billed-`class`'es](#billed-classes)
			- ["Tabeller"](#tabeller)
				- [Forklaring af opbygningen](#forklaring-af-opbygningen)
					- ["tabel"](#tabel)
					- ["celle"](#celle)
					- [Flere rækker](#flere-rkker)
			- [Engelske-tags](#engelske-tags)
			- [Styling](#styling)
				- [Centrering](#centrering)
				- [Kursiv](#kursiv)
			- [Anchor tags](#anchor-tags)
			- [Lodret luft](#lodret-luft)
	- [Om at bruge Hugo](#om-at-bruge-hugo)
	- [Andet](#andet)

<!-- /TOC -->

## Mappestruktur

Nedenfor kan du se en skitse af, hvordan filerne her er arrangeret.

```
ginger.hugo (den overordnede mappe, hovedmappen)
├── config.toml (opsætning)
├── content (mappe med indhold)
│   ├── README.md (denne fil)
│   ├── _ethnic.md (indholdet til siden _ethnic)
│   ├── ... (masser af andet indhold)
│   └── workinprogress.md (indholdet til siden workinprogress)
├── public (mappe)
│   └── ...
├── static (mappe)
│   └── images (mappe)
└── themes (mappe)
    └── ginger-bs (mappe)
```

Hvis vi starter med filerne her i hovedmappen, ginger.hugo. Dem skal du så sådan set slet ikke forholde dig til, men her er alligevel en lille forklaring.

- `config.toml`: Indeholder nogle indstillinger, der styrer din side. Den skal du sådan set ikke bekymre dig om.

Så kan vi tage mapperne. Du skal især koncentrere dig om `content/` og `static/`, så dem starter vi med:

### `content/`
Mappen `content/` indeholder selve dit tekstindhold -- det, der i gamle dage var dine HTML-filer ligger nu her i Markdown-format i stedet. Markdown omtales nærmere nedenfor. 

Hver markdown-fil i denne mappe bliver til en tilsvarende .html-fil på den færdige hjemmeside -- og får samme adresse om markdown-filen (så `links.md` bliver til `gingerdolls.dk/links`).

Som et lidt specielt indhold, har jeg lagt denne fil herind -- så du kan se, hvordan kodestumperne oversættes af Hugo.

### `static/`
Mappen `static/` indeholder dit *statiske* indhold. Denne mapper bliver kopieret *direkte* ind i den færdige hjemmeside, så undermappen `static/images/` her på computeren bliver til `gingerdolls.dk/images/` på nettet. Så det er også her, du skal lægge dine billeder ind. 

Det vil også sige, at når du skal linke til filer, du har placeret i `static/`, skal du kun skrive adressen *efter* `static/`, dvs. fx `images/1.jpg`.

Hvis du skal dele ikke-gingerdolls.dk-relaterede ting med andre (som fx de cello-billeder, du delte med mig), vil jeg foreslå, vi skifter til at benytte et underdomæne til det -- så det eneste indhold, der ligger på serveren er det, der kommer direkte fra Hugo her på computeren.

### De to mindre vigtige mapper, `public/` og `themes/`

At kalde `public/` for ikke-vigtig passer sådan set ikke -- for det er her, din hjemmeside bliver spyttet ud af Hugo. Men det betyder også, at `public/` er en mappe, du ikke skal bruge til andet end at uploade. Du må ikke ændre noget herinde, for det vil blive overskrevet næste gang.

`themes/`-mappen er der, hvor jeg har lagt dit tema. Det er ikke et sted, du skal begive dig ind -- så hellere spørge mig om hjælp. :-)

## At tilføje/redigere indhold

Som sagt ligger alt dit indhold i mappen `content/`. Prøv at åbne en tilfældig fil derfra.

### Indhold-filens anatomi

Filen starter med noget i denne stil (fra _ethnic.md):

```
---
date: "2017-02-28T16:35:10+01:00"
title: "_ethnic"
---

# ETNISKE DUKKER
# ETHNIC DOLLS - TOURIST DOLLS


Jeg har besluttet at lave en side med de etniske dukker, dvs. indianer-
og Hawaiidukker *OG* Laplandsdukker. De er så her nedenfor.
```
 
Den del, der ligger mellem de to linjer med `+++` er det, der kaldes "front matter". Det indeholder i dit tilfælde kun to variable, nemlig:

- `date`: Der i et lidt forvirrende datoformat fortæller, hvornår siden er oprettet (eller, som det er mere relevant i dit tilfælde: ændret)
- `title`: Som giver titlen på siden. Dette er ikke lig overskriften på siden, men må gerne være noget unikt/id-lignende (fx Ginger 34). `title`-feltet vil være synligt på din 404-side og i faneblad-listen, hvor det står som "GingerDolls - `title`".

Alt det, der kommer under de nederste `+++`'er, er selve indholdet. Så nu kommer vi til introduktionen til Markdown.

### Markdown

Markdown er et simpelt, lille kodesprog, der væsentligst kan benyttes til prosa. Dvs. det sådan set ikke kan håndtere layouts i det væsentlige. Men selve teksten er Markdown god til. 

En af fordelene ved, at du skal bruge Markdown, er også at fjerne noget af "ansvaret" fra dig. Du skal skrive **indhold** og *ikke udseende*. Så fx at du vil have overskrifter i versaler er noget, *jeg* skal løse, mens du bare skal skrive din overskrift, som den grammatisk skal være. Det skal holdes så simpelt som muligt for dig.

Nedenfor ses en kort vejledning til de ting, du nok skal bruge mest. For mere udførlige lister, henviser jeg til fx [denne side](https://github.com/adam-p/markdown-here/wiki/Markdown-Cheatsheet).

#### Afsnit

Afsnit laves bare ved at efterlade mindst én tom linje mellem afsnittene:

```
Her er et afsnit.

Her er et andet.
```

Her er et afsnit.

Her er et andet.

##### Enkelte linjeskift

Hvis du bare vil lave et *enkelt* linjeskift, sv.t. HTML's `<br>`, gøres det ved at have **to mellemrum til slut på en linje**.

```
Nu vil jeg gerne  
bryde linjen.
```

Nu vil jeg gerne  
bryde linjen.


#### Overskrifter

Overskrifter kan laves på flere måder, jeg anbefaler at benytte et varierende antal `#`'er foran overskriften (der *ikke må indeholde linjeskift her i editoren*).

Nedenfor er en liste og det tilsvarende HTML-tag, som du måske husker

```
# Overskrift 1 (h1)

## Overskrift 2 (h2)

### Overskrift 3 (h3)

#### Overskrift 4 (h4)

##### Overskrift 5 (h5)

###### Overskrift 6 (h6)
```

# Overskrift 1 (h1)

## Overskrift 2 (h2)

### Overskrift 3 (h3)

#### Overskrift 4 (h4)

##### Overskrift 5 (h5)

###### Overskrift 6 (h6)

Du skal dog bemærke, at overskrifterne 1 og 2 også kan laves med hhv. `===` og `---` på linjen under -- jeg nævner dette, fordi man kan komme til at lave en overskrift, hvis der ikke er en tom linje efter overskriften.

#### Fed, skrå, gennemstreget skrift

```
**Fed skrift**  
*Skrå skrift* (eller _skrå skrift_)  
***Både fed og skrå skrift*** (eller **_Både fed og skrå skrift_**)  
~~Gennemstreget~~  
```

**Fed skrift**  
*Skrå skrift* (eller _skrå skrift_)  
***Både fed og skrå skrift*** (eller **_Både fed og skrå skrift_**)  
~~Gennemstreget~~  

#### Vandrette streger til inddeling

At lave en vandret streg er uhyggeligt nemt. I HTML ville det være `<hr>` -- i Markdown er det bare

```
Over

---

Under
```

hvilket giver:

Over

---

Under

Her er det så, du skal sørge for, der er en tom linje på hver side af stregen (særligt over) for at undgå at lave overskrifter.

#### Links og enkle billeder
##### Links
Markdown håndterer også links virkelig nemt:

```
[Dette skal vises på siden](her er adressen)

Fx, et link til Google:
[Verdens største søgemaskine](http://google.dk)
```

[Verdens største søgemaskine](http://google.dk)

##### Billeder
Billeder minder meget om links i ren markdown. De er dog meget ufleksible og er kun noget, du skal bruge sjældent. Syntaksen er her -- den er magen til links, bortset fra et `!` til start:

```
![alt-tekst](billedadressen)

Fx, et link til en kat
![En rød kat](http://writm.com/wp-content/uploads/2016/08/Cat-hd-wallpapers.jpg)
```
Som sagt er den dog ufleksibel. Og til dit brug (med thumbnails, større udgaver, evt. links til en anden side osv.) anbefaler jeg, du i stedet bruger den kodestump, du kan finde nedenfor.

### Kodestumper til dit indhold

Hugo tillader mig at kode nogle "relativt simple" kodestumper, som du kan indsætte -- og som derefter omdannes til HTML ud fra det, jeg har valgt. P.t. er der ikke så mange. Hvis du savner noget, må du sige til, så kan jeg tilføje det.

Vi starter hårdt ud med billeder, som er den svære. De øvrige er noget nemmere.

#### Billeder

Koden for at indsætte et billede ser voldsom ud -- men den kan kortes ned, hvis der er elementer, du ikke bruger på det enkelte billede. I så fald sletter du bare den linje.

```
{{</* img src="LINK TIL BILLEDE" 
    caption="TEKST DER VIL STÅ UNDER BILLEDET OG VED FORSTØRRELSE" 
    gallery="HVIS BILLEDET ER EN DEL AF ET GALLERI, SÅ ET UNIKT (FOR SIDEN) NAVN HER"
    link="LINK TIL EN ANDEN SIDE/BILLEDE _ELLER_ (EN EVT. STØRRE UDGAVE AF) BILLEDET" 
    title: "SKAL DU NOK SJÆLDENT BRUGE -- BLIVER STOR SKRIFT" 
    class="CSS-CLASSES FOR AT STYLE/TILFØJE FUNKTIONER" 
    alt="ALT TEKST ER KUN NØDVENDIG, HVIS DU IKKE SÆTTER CAPTION" 
*/>}}
```

`caption` og/eller `alt` bør sættes -- både af hensyn til validering og hvis billedet ikke virker eller af hensyn til svagtseende (men ok, dem har du næppe mange af).

Dette giver, med katten fra før:

```
{{</* img src="http://writm.com/wp-content/uploads/2016/08/Cat-hd-wallpapers.jpg" 
    caption="CAPTION" 
    gallery="kat"
    link="http://writm.com/wp-content/uploads/2016/08/Cat-hd-wallpapers.jpg" 
    title: "TITLE" 
    class="klik height-300" 
    alt="ALT -- Kan slettes, i så fald overtages af caption" 
*/>}}
```

{{< img src="http://writm.com/wp-content/uploads/2016/08/Cat-hd-wallpapers.jpg" 
    caption="CAPTION" 
    gallery="kat"
    link="http://writm.com/wp-content/uploads/2016/08/Cat-hd-wallpapers.jpg" 
    title="TITLE" 
    class="klik height-300" 
    alt="ALT -- Kan slettes, i så fald overtages af caption" 
\ >}}

Hvis `klik` var udeladt fra `class`-feltet, ville billedet bare linke til selve billedet (som din side har gjort hidtil).

##### Billed-`class`'es

Det mindst gennemskuelige her er den del, der hedder `class=`. Den kan del benyttes til at style dit billede (fx sætte en maksimal højde på) eller til at tilføje funktioner -- fx for at få et thumbnail til at åbne det store billede i en popup, kræves det, at der står `klik` et sted i `class`. Classes kan adskilles med mellemrum.

Her er de foreløbigt tilføjede classes:

- `klik`: Muliggør åbning af galleri/større billede
- `height-100`: Begrænser billedhøjden til 100px
- `height-150`: Begrænser billedhøjden til 150px
- `height-...`: Begrænser billedhøjden til et tal DELELIGT MED 50.
- `height-500`: Begrænser billedhøjden til 500px (max foreløbigt).

#### "Tabeller"

Det indhold, du før har haft i HTML's table-tags, skal over i noget andet. Tabeller er nu om dage *kun* til reelle tabeller, fx skemaer. Af hensyn til din overgang, har jeg dog holdt lidt fast i samme nomenklatur. Metoden er opbygget således:

```
{{%/* tabel */%}}
{{%/* celle 3 */%}}
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec varius lectus
libero, a convallis erat euismod sit amet. Donec lobortis massa sit amet
malesuada dictum.
{{%/* /celle */%}}

{{%/* celle 9 */%}}
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec varius lectus
libero, a convallis erat euismod sit amet. Donec lobortis massa sit amet
malesuada dictum.
{{%/* /celle */%}}
{{%/* /tabel */%}}
```

Hvilket giver følgende indhold:

{{< grid >}}

Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec varius lectus
libero, a convallis erat euismod sit amet. Donec lobortis massa sit amet
malesuada dictum.



Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec varius lectus
libero, a convallis erat euismod sit amet. Donec lobortis massa sit amet
malesuada dictum.

{{< /grid >}}

##### Forklaring af opbygningen

###### "tabel"
`{{%/* tabel */%}}` starter egentlig ikke en tabel **men en række**. Så hver gang, du vil bryde en linje uanset skærmstørrelse, skal du starte en ny "tabel" med ovenstående kode (og huske at lukke den foregående med `{{%/* /tabel */%}}`)

###### "celle"
```
{{%/* celle X */%}}
INDHOLD
{{%/* /celle */%}}
```

Laver så en celle, der fylder X af 12 felter (det er normalt at dele skærmen op i 12 felter) på skærme større end telefoners opløsning. På en telefon, vil den fylde halvdelen (med mindre X=6, med de nuværende indstillinger). Du kan have lige så mange felter, du vil, efter hinanden. Selvom deres sum bliver mere end 12, vil der ikke ske andet end at det bryder ned på næste linje.

###### Flere rækker

For at lave flere rækker (fx på dine sider med lister over dukker; en række per dukke), skal du altså bare gentage ovenstående koder (bemærk tabel/række nummer to har omvendt bredde af nummer 1):

```
{{%/* tabel */%}}
{{%/* celle 3 */%}}
1. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec varius lectus
libero, a convallis erat euismod sit amet. Donec lobortis massa sit amet
malesuada dictum.
{{%/* /celle */%}}

{{%/* celle 9 */%}}
2. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec varius lectus
libero, a convallis erat euismod sit amet. Donec lobortis massa sit amet
malesuada dictum.
{{%/* /celle */%}}
{{%/* /tabel */%}}

{{%/* tabel */%}}
{{%/* celle 9 */%}}
3. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec varius lectus
libero, a convallis erat euismod sit amet. Donec lobortis massa sit amet
malesuada dictum.
{{%/* /celle */%}}

{{%/* celle 3 */%}}
4. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec varius lectus
libero, a convallis erat euismod sit amet. Donec lobortis massa sit amet
malesuada dictum.
{{%/* /celle */%}}
{{%/* /tabel */%}}

{{%/* tabel */%}}
{{%/* celle 6 */%}}
5. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec varius lectus
libero, a convallis erat euismod sit amet. Donec lobortis massa sit amet
malesuada dictum.
{{%/* /celle */%}}

{{%/* celle 3 */%}}
6. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec varius lectus
libero, a convallis erat euismod sit amet. Donec lobortis massa sit amet
malesuada dictum.
{{%/* /celle */%}}

{{%/* celle 3 */%}}
7. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec varius lectus
libero, a convallis erat euismod sit amet. Donec lobortis massa sit amet
malesuada dictum.
{{%/* /celle */%}}
{{%/* /tabel */%}}
```

Hvilket giver følgende. Prøv at gøre dit browser-vindue mindre for at se, hvad der sker.

{{< grid >}}

1 Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec varius lectus
libero, a convallis erat euismod sit amet. Donec lobortis massa sit amet
malesuada dictum.



2 Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec varius lectus
libero, a convallis erat euismod sit amet. Donec lobortis massa sit amet
malesuada dictum.



3 Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec varius lectus
libero, a convallis erat euismod sit amet. Donec lobortis massa sit amet
malesuada dictum.



4 Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec varius lectus
libero, a convallis erat euismod sit amet. Donec lobortis massa sit amet
malesuada dictum.



5 Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec varius lectus
libero, a convallis erat euismod sit amet. Donec lobortis massa sit amet
malesuada dictum.



6 Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec varius lectus
libero, a convallis erat euismod sit amet. Donec lobortis massa sit amet
malesuada dictum.



7 Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec varius lectus
libero, a convallis erat euismod sit amet. Donec lobortis massa sit amet
malesuada dictum.

{{< /grid >}}

#### Engelske-tags

I stedet for selv at lave links til den engelske udgave, kan du indsætte nedenstående der, hvor den engelske afdeling starter: 

```
{{%/* eng */%}}
``` 

{{< eng >}}

Dette laver linket i toppen (vil altid være i [toppen](#top) -- er det et problem?), som linker til det sted, hvor du insætter ovenstående kode.

#### Styling:

##### Centrering

Centrering af indhold gøres som sådan. Dog vil de fleste billeder allerede være centrerede -- så inden, du bruger koden, kan du lige tjekke, om det er nødvendigt.
```
{{%/* center */%}}
indhold 
{{%/* /center */%}}
```

Som bliver til:

{{% center %}}
indhold
{{% /center %}}


#### Anchor tags:

For at kunne indsætte et "anchor" (dvs. et gemt punkt på siden, du kan linke til) kan du gøre således:

```
{{</* anchor "navn" */>}}
```

Du linker så til det ved at bruge `sidens-adresse#navn` som vanligt.

#### Lodret luft

Hvis du vil have lidt ekstra luft mellem to afsnit, kan du bruge: 

```
{{</* spacer */>}}
```

Det ser sådan ud.

{{< spacer >}}

Aah. Godt med luft.

## Om at bruge Hugo

**OBS: Nedenstående afsnit er skrevet før jeg begyndte at arbejde på pluginnet til Atom. Så det er egentlig mindre vigtigt nu. Men du kan alligevel læse det, hvis du vil.**

 Hugo er et lille program, som skal installeres. Det skal jeg nok hjælpe med. 
 
 Når det er installeret, er der to kommandoer:
 
- `hugo watch` -- der laver en lokal webserver, du kan bruge, når du arbejder på siden. Så skal du bare pege din browser hen på http://localhost:1313 (via pluginnet er det dog http://localhost:9082).
- `hugo` -- der laver den endelige udgave af din side og spytter den ud i mappen `public/`. Dette skal så uploades til hjemmesiden, og så er alt opdateret.

## Andet

Hvis du mangler noget eller har spørgsmål -- så giv lyd!

Håber det er til at finde ud af!
