---
...
Redovisning
=========================



Kmom01
-------------------------

**Hur känns det att hoppa rakt in i objekt och klasser med PHP, gick det bra och kan du relatera till andra objektorienterade språk?**

Har gått tillbaka för att göra om den nya versionen av denna kursen.
Har mycket erfarenhet av både PHP och generell OOP. Använder en del
av vad jag gjort sedan tidigare, så var inga problem.

**Berätta hur det gick det att utföra uppgiften “Gissa numret” med GET, POST och SESSION?**

Det var ganska straight forward. Igen så hade jag mycket av uppgiften
färdig sedan v3 av kursen. Jag behövde bara göra lite ändringar
för att den skulle fungera enligt de uppdaterade kraven.

**Har du några inledande reflektioner kring me-sidan och dess struktur?**

Gjorde kursen Ramverk1 precis och det är kul att se att denna kursen numera är uppdaterad
för att ha en liknande struktur. Ska nog inte bli några problem att arbeta med den.

**Vilken är din TIL för detta kmom?**

Lite awkward men eftersom jag i stort sätt gjort detta kursmoment två gånger nu, och
arbetat mycket med objektorienterad PHP så har jag inte riktigt lärt mig någonting.
Menmen, det finns ju fler kursmoment.

Kmom02
-------------------------

**Hur gick det att överföra spelet “Gissa mitt nummer” in i din me-sida?**

Med hjälp av videoserien var det inga problem. Missade att den fanns först och stötte
på massa problem. Men när jag hittat den och följde den gick det bra.

**Berätta om hur du löste uppgiften med Tärningsspelet 100, hur du tänkte, planerade och utförde uppgiften samt hur du organiserade din kod?**

Jag ville göra strukturen så tydlig som möjligt och ville se till att ha så lite logik i routerna
som möjligt. Jag skapade en Player-klass som kan göra allt man vill kunna med en Dice. Sedan har
jag en klass för Game, med två primära funktioner: Roll och Stop. Dessa sköter, med hjälp av
några privata funktioner, igentligen allt spelet går ut på.

För att göra spelet tydligt för användaren skapade jag en variabel för spelets status,
och en för spelets historik. Statusen innehåller text om vad som just hände och history
innehåller historiken om vad som har hänt under spelets gång. Jag tyckte att det blev
riktigt snyggt och lättförstått för att vara så simpelt.

**Berätta om din syn på modellering likt UML jämfört med verktyg som phpDocumentor. Fördelar, nackdelar, användningsområde? Vad tycker du om konceptet make doc?**

Jag tycker att phpDoc genererar lite mycket filer jämfört med vad andra dokumentationsprogram
gör(i min erfarenhet i alla fall). Dock är det ju smart att inte behöva göra något mer
än att se till att ens kod att kommenterad korrekt, vilket är ett bra initiativ. UML
är dock snyggare och tydligare, men med nackdelen att det är jobbigare att göra.

**Hur känns det att skriva kod utanför och inuti ramverket, ser du fördelar och nackdelar med de olika sätten?**

Små grejer som Dice100 och Guess föredrar jag nästan utanför ramverket då de inte riktigt har
så mycket med sidans arkitektur att göra. Men jag tycker defenitivt att det är smidigt
att implementera saker i ramverket när man väl gör det.

**Vilken är din TIL för detta kmom?**

Jag lärde mig lite om hur man skriver ut biter av bilder med hjälp av CSS. Det var
väldigt likt sprites. Jag lärde mig även lite mer om skillnaden med self och this.

Kmom03
-------------------------

**Har du tidigare erfarenheter av att skriva kod som testar annan kod?**

Ja jag har skrivit ganska mycket enhetstester förut. Både i större och mindre
projekt.

**Hur ser du på begreppen enhetstestning och att skriva testbar kod?**

Jag tycker att det är viktigt att sikta mot att skriva testbar kod. Inte bara för
att enhetstestning är viktigt, men för att det hjälpter till att se till att koden
är "to the point". Blir en funktion för komplicerad att enhetstestad är det oftast
för att den är för komplicerad redan från början.

**Förklara kort begreppen white/grey/black box testing samt positiva och negativa tester, med dina egna ord.**

Whitebox innebär testning där man har förståelse och tillgång till den kodstruktur man testar.
Detta gör att man kan skriva tester som inte bara hanterar input/output, men även
hur väl uppgiften utförs.

Blackbox är testning där man INTE har tillgång till själva kodens struktur. Detta innebär
att testningen är låst till input/output-testing.

Greybox är ett slags mellansteg där man har begränsad tillgång till kodstrukturen så som
UML-diagram exempelvis. Det gör att man har större möjlighet att testa ickefunktionella krav
och annat som inte direkt tillhör enbart input/output.

Det positiva med tester är att man bidrar med en större grad säkerhet till att det
man har utvecklat faktiskt fungerar, både under utveckling och efter leverans. Det negativa
är att det tar bort tid från utvveckling.

**Hur gick det att genomföra uppgifterna med enhetstester, använde du egna klasser som bas för din testning?**

Jag använde exempelkoden. Jag såg att man kommer testa sina egna program i senare kursmoment,
så jag använde denna övning främst för att visa att jag förstår hur enhetstester fungerar.

**Vilken är din TIL för detta kmom?**

Att det tydligen är acceptabelt, i alla fall i phpUnit, att ha flera assertions i
ett testfall. Jag har tidigare strikt skrivit EN assertion/test case. Föredrar nog
att göra så för tydlighetens skull, även fast jag inte gjorde det i detta kursmoment.



Kmom04
-------------------------

**Vilka är dina tankar och funderingar kring trait och interface?**

Interface kan vara smidigt för att förtydliga vad som behöver implementeras för
att något ska klassas som något speciellt. Trait tycker jag kan bli lite svårtydigt.
Om man implementerar en interface tycker jag att man ska implementera funktionerna
som krävs direkt i klassen. När man har det i en trait så måste man helt plötsligt
gå in i ännu en till fil. Har man flera traits blir det svårt, enligt mig, att se
exakt vad klassen har tillgång till.

**Hur gick det att skapa intelligensen och taktiken till tärningsspelet, hur gjorde du?**

Jag avnänder slumpad procentuell chans för AIn att forsätta spela. Sedan har jag olika states
som antingen ger högre eller lägra chans för AIn att ta beslutet att fortsätta spela.
Det är lite olika saker som poängskillnad, mängd slag denna rundan och hur nära man är
100 poäng som påverkar bland annat.

**Några reflektioner från att integrera hårdare in i ramverkets klasser och struktur?**

Tycker främst att det är bra att använda så lite konstanter som möjligt. Utöver det
tyckte jag att request-modulen var lite för simpel. Tycker att det borde finns en has()
funktion exempelvis för att se om ett värde är satt, så som i Session-klassen.

På tal om Session så hade jag en egen klass för det som jag fick med mig från v3
av kursen och jag använde den istället för Anax/Session.

**Berätta hur väl du lyckades med make test inuti ramverket och hur väl du lyckades att testa din kod med enhetstester och vilken kodtäckning du fick.**

Jag fick uppåt 50% kodtäckning totalt. Det är ganska tråkigt att skriva tester, speciellt
när funktionaliteten redan är implementerad. Därför gjorde jag bara typ 10 tester totalt.
Det är lite annorlunda när man jobbar med ett större projekt som har lite mer tyngd.
Här ville jag bara visa att jag kunde.

**Vilken är din TIL för detta kmom?**

Jag lärde mig mer i detalj om Trait.


Kmom05
-------------------------

**Några reflektioner kring koden i övningen för PHP PDO och MySQL?**

Den följer ju en viss struktur som i grunden är okej, men jag tycker att det overall
är lite rörigt. Hade kanske varit bättre att jobba med någon form av klasstruktur
för Movie?

**Hur gick det att överföra koden in i ramverket, stötte du på några utmaningar?**

Det gick mycket bra. Hade ju gjort på samma sätt med Guess och DiceGame så nu
känner jag mig ganska säker på hur man går tillväga. Stötte inte på några problem
med själva integrationen.

**Berätta om din slutprodukt för filmdatabasen, gjorde du endast basfunktionaliteten
eller lade du till extra features och hur tänkte du till kring användarvänligheten
och din kodstruktur?**

Jag lade till paginering och kolumnsortering, men bara eftersom jag redan hade det
färdigt sedan förra versionen av kursen. Gjorde minimal styling men det känns användarvänligt.
Det blev lite mycket kod i routerna dock. Jag hade nog föredragit en klasstruktur för
Movie i *src/*-mappen med inbyggd koppling till databasen. Något liknande hur man gör
med ARM i Ramverk1. Meeen, nu gjorde jag ju denna kursen efter Ramverk1 så jag kan acceptera
att man håller sig till lite mer basics i denna kursen.

**Vilken är din TIL för detta kmom?**

Har bra koll på databas, PDO och PHP i allmänhet. Dock kom jag på ett smart sätt
att lösa sökfunktionaliteten. Jag lade in två submitknappar med title/year som värde
så jag slapp ha två formulär, eller att man skulle behöva söka i båda kolumnerna.
Inte superhäftigt, men det var något nytt för mig i alla fall.



Kmom06
-------------------------

*Eftersom detta kursmomentet är exakt samma som en av uppgifterna i oophp-v3 kmom04 så kommer några
av följande svar vara kopierade från när jag faktiskt gjorde uppgiften.
Denna gången har jag i stort sätt bara kopierat in det mesta för att få det att fungera i v4.*

**Hur gick det att jobba med klassen för filtrering och formatting av texten?**

Tycker det är ganska skönt att ha en klass som sköter det separat. Det gör att man slipper hantera sådant
individuellt i vyn. Jag hade personligen lite problem med namngivningen. Eftersom Anax\Textfilter redan
finns så blev det knas när jag döpte min egna till Textfilter. Problemet var angående autoloading, men
jag gjorde en fulfix och bara döpte min klass till ReblexTextFilter iställer.

**Berätta om din klasstruktur och kodstruktur för din lösning av webbsidor med innehåll i databasen.**

Jag valde att skapa en klass som heter ContentHandler. Den tolkar vilken typ av content som ska visas och
hämtar det från databasen. Sedan skickas den datan för att visas i en view baserad på vad det
är för typ av content(page/blog/block). Detta gör att allt går igenom en och samma hantering, och det
slipper bli onödigt mycket kod i vyerna.

**HUr känner du rent allmänt för den koden du skrivit i din me/redovisa, vad är bra och mindre bra?
Ser du potential till refactoring av din kod och/eller behov av stöd från ramverket?**

Jag gillar att ha en hanterare. Dock skulle det kanske blivit ännu smidigare om hanteraren
hade tillgång till specifika klasser för post och blog. Jag slapp ha massa kod i routerna,
men de blev väldigt lika. Det kanske kunde funkat att göra någon bättre hantering för det.

Jag har i stort sätt bara kopierat min content-lösning från kmom04 i oophp-v3 då det
är samma uppgift, så jag ville inte börja ändra för mycket då jag kanske skulle krångla
till det. En sak jag i efterhand kan tänka mig vore värd att ändrar dock är att vissa
routes pratar med controllern, vilket är lite konstigt. Den hanteringen borde finnas
i routerna, så som ramverket ser ut nuförtiden.

**Vilken är din TIL för detta kmom?**

Jag hade gjort exakt detta kursmomentet innan och arbetat mycket i anax, så jag
kan faktiskt inte komma på någon speciell lärdom.


Kmom07-10
-------------------------


**Implementerade krav**
Jag har implementerat grundkraven 1, 2 och 3.

**Struktur**

Jag började projektet med att arbeta fram en tabellstruktur för databasen. Jag valde att använda tre tabeller: User, Blog och Product. Jag gillar att börja med just detta för när jag satt upp tabellerna vet jag vad mitt system behöver kunna hantera.

Jag valde att använda ARM som finns inbyggt i Anax\Database för att hantera User Blog och Product som objekt. Jag gjorde därför tre klasser som implementerar ARM(liknande hur man gör i Ramverk1). Detta gjorde det lätt att arbeta med databasen då alla klassernas objekt hade samma struktur.

Mycket av sidan är kopierat från redovisningssidan då det grundar mycket i samma tänk. Jag arbetade för att se till att inte ha så lite logik som möjligt i vyerna genom att hantera variabler i routerna med hjälp av klass-objekten kopplade till user/blog/product.

**Funktionalitet**

Bloggen fungerar väldigt likt den blogg som gjordes i kmom06 och har i stort sätt samma funktionalitet. Man kan se en översikt av alla inlägg på förstasidan och man kan läsa inlägget i sin helhet om man klickar på det. Jag valde att använda samma vy för både scenarion genom att ha bloggens "slug" som en GET-variabel och sedan kolla om vyn har fått ett eller flera blogginlägg från routern. Det stod att även bloggen skulle kunna ha bilder, och det tolkade jag som inline bilder i markdown. Därför gäller det att ha markdown-filtrer påslaget om man vill att bilderna ska fungera. Därför har jag gjort så att markdown-filtret är default för blogginlägg(men man kan stänga av det om man vill som admin).

Produkterna fungerar på samma sätt som bloggen för enkelhetens skull. Här är det hårdkodat att beskrivningen använder markdown dock.

För att komma till adminvyn går man till Konto och om man är inloggad som administratör kan man klicka sig till adminvyn. Denna vy är mycket lik hanteringen för filmdatabasen. Man kan se alla blogginlägg samt produkter och därifrån skapa/redigera/ta bort var man vill. Då BlogPost och Product fungerar på ett väldigt likt sätt har jag valt att använda delade vyer för deras hantering. Jag använder på samma sätt som blogg-vyn en GET-variabel för att visa vilken typ av "content" som ska redigeras/skapas och en annan för själva ID't. Vyn renderar de fält som behövs för just den typen, vilket jag tyckte var ganska smidigt.

Jag skrev tester för mitt textfilter och uppnådde 100%. Jag skrev även för min egna Sessionsklass och uppnådde där 84% samt 26% bland mina ensamstående hjälpfunktioner. Detta blev totalt 37% för hela projektet vilket jag tycker är helt okej. Min ambition är att få Godkänt så det får räcka.


**Allmänt om projektet**

En av mina favouritlösningar, även om den är liten, är hur jag hanterade en del av inloggningen. Jag ville att man skulle kunna se Hem och Om-sidan utan att vara inloggad för att få en överblick av sidan, men jag ville kräva inloggning för tillgång till Blogg och Produkter. Problemet var att man skickades till Konto-sidan när man loggat in och inte tillbaka till Blogg/Produkter. Jag kunde inte använda HTTP_REFERER-konstanten eftersom inloggningsformuläret hade referer till sig själv. Jag löste detta genom att använda en variabel i sessionen som "referer" och omdirigera efter inloggning baserat på den.

Jag tyckte även att det var ganska smidigt, som jag nämnde tidigare, att ha delade vyer för redigering/skapning av content. Visst, det blev lite extra kod i vyerna, men jag slapp skapade många fler vyer och routes vilket jag blivit lite trött på från att ha gjort både Ramverk1 och OOPHP i rad.

Projektet kändes lagom. Man kunde visa upp att man hade förstått allt man gått igenom i kursen, vilket är hela poängen. Det var inte särskillt svårt, men jag har skrivit en hel del objektorienterad PHP vid detta laget, speciellt i Anax, vilket gav mig en väldigt stabil grund.


**Tankar kring kursen**
Version 4 av kursen kändes som en normal kurs, till skillnad från v3. Jag hade gjort allt till och med kmom04 i v3, och det var i stort sätt hela v4, förutom projektet. Jag gillade den nya versionen av DiceGame, den kändes ganska så lärorik, även fast jag redan kunde det mesta.

Allt som allt tycker jag att detta numera är en bra kurs för att inleda folk till objektorienterad PHP. Kör vidare på denna!
