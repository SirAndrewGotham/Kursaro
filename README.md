## Kursaro

Kursaro estas informa projekto por prezenti ĝeneralajn informojn pri Esperanto (same kiel - eble - iu alia lingvo) kun informoj (ligiloj) pri lingvaj kursoj, kiujn ret-vizitantoj povas uzi por studi la lingvon.

Karaj geamikoj.

Mi ricevis peton konstrui retejon por meti informilon pri Esperanto.
La peto diras, ke devas esti unu paĝo en diversaj lingvoj kaj iu listo de ligiloj al Esperanto kursoj, kiujn vizitantoj povus uzi kaj trairi al la kursaj paĝoj mem.

Tio sonas tre simpla, programe necesas nur lingvo-ŝanĝilo.
Ĉion alian eblas meti en simplaj tekstaj dosieroj.

Tamen en tiu formo la tasko ne estas vere interesa por programi, ĉu?

Do, mi planas programi retejon kun administra parto, en kiu administrantoj povus laŭbezone facile aldoni tradukojn de la informilo
kaj fari ŝanĝojn al jam publikitaj lingvaj tradukoj.

Krome, laŭ mia ideo, tie estu iu formo de simpla katalogo de kursoj.
Tiu katalogo havu ĉefan materialon pri la kurso kaj tradukoj al diversaj lingvoj.
Same kiel kun la ĉefa informilo, administrantoj povos aldoni tradukojn kaj ŝanĝi la ekzistantajn laŭbezone.

Krome, etsu kategorioj, kiuj fakte servu kiel etikedoj. Ĉiu kurso povu havi kelkajn, ekzemle: reta [kurso], fizika, ktp.
Administrantoj ankaŭ havu eblecon marki ĉu iu aŭ alia kurso estu montrebla en ĉiuj lingvoj, aŭ nur kun la informo pri Esperanto en kelkaj specifaj lingvoj.
Specifaj kursoj estu troveblaj en tiuj kategorioj alklakante la etikedojn.

---
Rimarko: estus ankaŭ bone havi iun serĉ-sistemon por montri kursojn en landoj kaj urboj, interesaj por specifaj vizitantoj.
Eble eltrovi aŭtomate de kiu urbo venas la vizitanto kaj proponi kursojn (se ekzistas) en lia/ŝia urbo aŭ/kaj retaj.
Tamen tio tuj postulas iom tro multe da laboro, do mi lasu tiun taskon por estonto, kiam ĉio ĉefa kaj urĝa estos preta kaj funkcianta.
Se tiu funkciado estos konsiderata bezonata, mi tion prilaboros.
---

La kursoj montratoj al vizitantoj en la ĉefa paĝo ne estu ligiloj tuj prenantaj vizitantojn al la kursaj retejoj,
sed estu ligiloj al la katalogo da kursoj en la sama nia retejo, portanta vizitantojn al la plena priskribu pri la kurso:
kiu ĝi estas, kiu gvidas, kiuforma etas la kurso (reta aŭ fizika), ĉu estas paga aŭ ne,
kontaktoj (retpoŝta adreso, telefono, ktp. se administranto decidos montri ilin al vizitantoj).
En tiu kataloga paĝo jam estu ligilo al la kurso, kaj se vizitanto decidos, li/ŝi povas trairi al la kursa retejo.

Sekva funkciado mi aldonu: ebleco por vizitantoj sendi proponojn pri kursoj al administrantoj.
Nun registrado en la sistemo ne estas supozata.
Vizitantoj (eble kursgvidantoj, ĉu?) povos plenigi specialan formon kun informoj pri kurso, tiu estu konservata en la sistemo por administrantoj.
Administranto havos eblecon aprobi la informojn, tiam informo pri la kurso aperos en la reteja kursa katalogo.
Samtempe, en la sama forma plenomata per vizitantoj, mi planas meti registradan sub-formon plenigatan laŭdezire.
Se vizitanto ekvolos samptempe registriĝi en la retejo, li/ŝi tion povos fari.
Tio ebligos la vizitanton poste gvidi kaj kontroli informojn pri sia kurso kaj ŝanĝi laŭbezone (ekzemple, kiam kontaktoj ŝanĝiĝos).

Sekva funkciado - komunikado de iu liberforma informo al la administrantoj.
Tiu simple estos savita en la sistemo por administrantoj reagi.
Samtempe tiu informo estos aŭtomate sendata al al administranta retpoŝto, kaj eble al lia/ŝia telegrama konto, votsapa konto, ktp.
Tiuj lastaj ankaŭ verŝajne ne estos plenumitaj en la unua varianto de la sistemo, sed lasita pro plenumi estonte.

Teksta enhavo de la retejo estu:
- Ĉefa informilo pri Esperanto;
- Aliaj paĝoj bezonataj (kiel "Pri la retejo", "Konfidenco", ktp).
  Ĉiuj tekstaj paĝoj estos prezentataj en multaj lingvoj, selekteblaj per vizitanto.
  Se mankas traduko de iu paĝo al iu elektita lingvo, iu defaŭlta varianto (markita per administranto) estos montrata al la vizitanto.

Krom ĉio supre, mi ankaŭ planu kaj dezajnu funkciadon, kiun mi nomu "standartoj", kvankam temas ne pri standartoj rekte.
Do, eblos havi reklam-standartoj se tio estos dezirata, tamen eblos uzi certajn partojn de la retejo pro montri iun aldonan informon,
kiel pri aliaj (eble partneraj) retejoj, eventoj, ktp.
Tiu funkciado estos ŝaltebla per administranto laŭbezone. Kiu ankaŭ markos por kiuj lingvoj.
Nu, kompreneble, se en iu retejo uzonta la sistemon administranto volos montri standartojn al vizitantoj, tion eblos fari.

La tuta sistemo havos plenan API, ambaŭ por administraj taskoj kaj por la vizitanta parto de la retejo.
Tio ebligos prepari frontojn de la sistemo uzante iu ajn teknologioj (Angular, React, Vue, ktp.), programi telefonan aplikaĵon, uzi frontojn en la domenoj aparte de la malfronto.

=====
Jen estas la plano
---
Nun jam estas preta arkitekturo de la projekto, kaj baza programa fundamento surbaze de la Laravel framo.
Databazon mi planas uzi SQLite (almenaŭ por nun, sed fina povas esti alia), kaj Teilvindon kiel CSS-framo.
Mi desegnu iun fronton por la retejo, tiam eblos jam vidi kiel la retejo aspektos.
Depende de kiom mi estos okupata en mia ĉefa laboro, mi planas havi la unuan skizon sekvontsemajne (ni diru, ĝis la 14-a de Novembro), certe ne firma, tamen planata.

---
Mi planas fari la kodon de la projekto libere disponebla, kaj povos konsulti pri instalado kaj respondi al iuj ajn demandoj pri la sistemo.

=====
Mi invitas ĉiujn amikojn, kiuj povus ekinteresiĝi pri tiu tipo de retejo, skribi sian opinion, kunhavi siajn ideojn, ktp.
Estas tre bonaj ŝancoj, ke mi inkorpigos en la sistemo iu ajn funkciado vi bezonas por sia tiutipa retejo, do ne timu kaj kontakru!
Plej bone estas tion fari en la Telegrama grupo "Retejo Esperanta" (https://t.me/retejoesperanta).
Min rekte eblas kontakti en Telegramo (https://t.me/sirandrewgotham), aŭ en Votsapo: +8 775 556 9244 (rimarku, ke mi ege malofte respondas al telefonvokoj de nekonataj numeroj, do plej bone skribu).

Mi publikigos pli da informo kaj pri la progreso (same kiel pri aliaj projektoj) en la Telegram-grupo "Retejo Esperanta" (https://t.me/retejoesperanta).

Mi deziras al vi ĉion bonan,
restante via, Andreo



