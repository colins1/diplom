/*"use strict"

// РџРѕРєР°Р· popup РѕРєРЅР° 
function showPopup(url) {
  return (event)=>{
    event.preventDefault();
    createRequest({
      url: url,
      callback: (data) => {
        document.getElementsByTagName('body')[0].insertAdjacentHTML("afterbegin", data.popup.result);
        popupStart();
      }
    });
  }
}


function popupStart() {
  // РљРЅРѕРїРєР° Р—РђРљР Р«РўР¬
  const buttonClose = document.getElementsByClassName('popup__dismiss')[0];
  buttonClose.addEventListener('click', popupClose);
  // РљРЅРѕРїРєР° РћРўРњР•РќРђ
  const buttonCancel = document.getElementsByClassName('conf-step__button-regular')[0];
  buttonCancel.addEventListener('click', popupClose);
  // РљРЅРѕРїРєР° OK
  const buttonOk = document.getElementsByClassName('conf-step__button-accent')[0];
  buttonOk.addEventListener('click', (event) => {
    event.preventDefault();
    let params ="";
    if (event.target.dataset.event == "hall_add") {params = hallAddParams()}
    if (event.target.dataset.event == "hall_del") {params = hallDelParams()}
    if (event.target.dataset.event == "film_add") {params = filmAddParams()}
    if (event.target.dataset.event == "film_del") {params = filmDelParams()}
    if (event.target.dataset.event == "seance_add") {params = seanceAddParams()}
    if (event.target.dataset.event == "seance_del") {params = seanceDelParams()}
    if (!params) {return};
    params += "&event=" + event.target.dataset.event
    createRequest({
      params: params,
      url: "/admin/scripts/events.php",
      callback: (data) => {
        if (data.halls) {dom.halls = data.halls.result}
        if (data.films) {dom.films = data.films.result}
        if (data.seances) {dom.seances = data.seances.result}
        dom.drawContent(); // РћР±РЅРѕРІР»СЏРµРј РІСЃРµ СЃРѕРґРµСЂР¶РёРјРѕРµ        
        popupClose(event);
      }
    });
  }); 
 
  if (buttonOk.dataset.event == "film_add") {
    // РљРЅРѕРїРєР° Р·Р°РіСЂСѓР·РёС‚СЊ РїРѕСЃС‚РµСЂ 
    const posterButton = document.querySelectorAll('.popup .conf-step__button-accent')[1];
    // РЎРѕР·РґР°РµРј РІРёСЂС‚СѓР°Р»СЊРЅС‹Р№ input СЃ type=file С‡С‚РѕР±С‹ Р·Р°РїСѓСЃС‚РёС‚СЊ РѕРєРЅРѕ РІС‹Р±РѕСЂР° С„Р°Р№Р»Р° РґР»СЏ Р·Р°РіСЂСѓР·РєРё РєР°СЂС‚РёРЅРєРё
    const input = document.createElement('input');
    input.type = 'file';
    let content = "";
    posterButton.addEventListener('click', (event) => {
      event.preventDefault();
      input.onchange = (e) => { 
        const file = e.target.files[0];
        if (file === undefined) {return}
        // РџСЂРѕРІРµСЂСЏРµРј СЏРІР»СЏРµС‚СЃСЏ Р»Рё С„Р°Р№Р» РёР·РѕР±СЂР°Р¶РµРЅРёРµРј (РґРѕРїСѓСЃРєР°СЋС‚СЃСЏ С„Р°Р№Р»С‹ jpg Рё png)
        if (file.type != 'image/png')  {
          alert('РћС€РёР±РєР° Р·Р°РіСЂСѓР·РєРё С„Р°Р№Р»Р°. Р—Р°РіСЂСѓР¶Р°РµРјС‹Р№ С„Р°Р№Р» РґРѕР»Р¶РµРЅ Р±С‹С‚СЊ С„РѕСЂРјР°С‚Р° png');
          return; 
        }
        // РџСЂРѕРІРµСЂСЏРµРј СЂР°Р·РјРµСЂ С„Р°Р№Р»Р°
        if (file.size > 1000000) {
          alert('РћС€РёР±РєР° Р·Р°РіСЂСѓР·РєРё С„Р°Р№Р»Р°! РњР°РєСЃРёРјР°Р»СЊРЅРѕ РґРѕРїСѓСЃС‚РёРјС‹Р№ СЂР°Р·РјРµСЂ Р·Р°РіСЂСѓР¶Р°РµРјРѕРіРѕ С„Р°Р№Р»Р° 1РњР‘.');
          return; 
        }
        const reader = new FileReader();
        reader.readAsDataURL(file);
        // Р•СЃР»Рё РёР·РѕР±СЂР°Р¶РµРЅРёРµ Р·Р°РіСЂСѓР¶РµРЅРѕ, С‚Рѕ РѕС‚РѕР±СЂР°Р·РёРј РµРіРѕ РІ popup РѕРєРЅРµ СЂСЏРґРѕРј СЃ С„РѕСЂРѕРјР№
        reader.onload = (readerEvent) => {
          content = readerEvent.target.result;
          if (content != "") {
            const poster =  document.querySelector('.popup__poster');
            poster.style.backgroundImage = `url(${content})`;
            posterFile = content; // Р—Р°РїРёСЃС‹РІР°РµРј СЃРѕРґРµСЂР¶РёРјРѕРµ С„Р°Р№Р»Р° РІ РїРµСЂРµРјРµРЅРЅСѓСЋ (РѕР±СЉСЏРІР»РµРЅР° РІ 4_gridSession.js)
            poster.style.width = '150px';
            poster.style.marginRight = "20px"
          }
        }  
      }
      input.click();
    })
    // РљРѕРЅС‚СЂРѕР»СЊ РІРІРѕРґР° РґР°РЅРЅС‹С… РІ РїРѕР»Рµ "РџСЂРѕРґРѕР»Р¶РёС‚РµР»СЊРЅРѕСЃС‚СЊ С„РёР»СЊРјР°"
    const inputFilmDuration = document.querySelectorAll('.popup .conf-step__input')[1]
    inputFilmDuration.addEventListener('keydown', (event)=>{ // Р—Р°РїРѕРјРёРЅР°РµРј С‚РµРєСѓС‰РµРµ Р·РЅР°С‡РµРЅРёРµ РїСЂРё РЅР°Р¶Р°С‚РёРё РєРЅРѕРїРєРё 
      event.target.dataset.lastValue = event.target.value;
    })
    inputFilmDuration.addEventListener('input', (event)=>{ // РєРѕРЅС‚СЂРѕР»СЊ Р·РЅР°С‡РµРЅРёСЏ
      const value = event.target.value;
      if ((value !== "") &&  ((isNaN(Number(value))) || (Number(value) <= 0) || (value.indexOf('.') >= 0))) {
        event.target.value = event.target.dataset.lastValue
      }
    })
  }

  // Р•СЃР»Рё СЃРѕР±С‹С‚РёРµ - "Р”РѕР±Р°РІР»РµРЅРёРµ СЃРµР°РЅСЃР°" С‚Рѕ Р·Р°РїРѕР»РЅСЏРµРј <select> СЃ Р·Р°Р»Р°РјРё Рё С„РёР»СЊРјР°РјРё 
  if (buttonOk.dataset.event == "seance_add") {
    // Р—Р°Р»С‹
    const selectHall = document.querySelectorAll('.popup .conf-step__input')[0];
    const hallId = document.querySelector('.popup').dataset.hallId;
    let html = "";
    Array.from(dom.halls).forEach(hall => {
      const selected = (hall.hall_id ==  hallId) ? 'selected' : '';
      html += `<option value="${hall.hall_id}"  ${selected}>${hall.hall_name}</option>`
    });
    selectHall.innerHTML = html;
    // Р¤РёР»СЊРјС‹
    const selectFilm = document.querySelectorAll('.popup .conf-step__input')[1];
    const filmId = document.querySelector('.popup').dataset.filmId;
    html = "";
    Array.from(dom.films).forEach(film => {
      const selected = (film.film_id ==  filmId) ? 'selected' : '';
      html += `<option value="${film.film_id}"  ${selected}>${film.film_name}</option>`
    });
    selectFilm.innerHTML = html;
  }
}


function popupClose(event) {
  event.preventDefault();
  const popup = document.getElementsByClassName('popup')[0];
  popup.classList.toggle('active');
  popup.remove();
  posterFile = "" // РћР±РЅСѓР»СЏРµРј РїРµСЂРµРјРµРЅРЅСѓСЋ С…СЂР°РЅСЏС‰СѓСЋ РёР·РѕР±СЂР°Р¶РµРЅРёРµ РїРѕСЃС‚РµСЂР° 
}

*/