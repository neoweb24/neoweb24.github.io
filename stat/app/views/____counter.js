// 
let pageViews = localStorage.getItem('pageViews')
let firstVisit = localStorage.getItem('firstVisit')
let lastVisit = localStorage.getItem('lastVisit')

// в строке не только цифры (или переменная пуста)
if(!pageViews || !pageViews.match(/^\d+$/)) pageViews = 0
// в строке не только цифры (или переменная пуста)
if(!firstVisit || !firstVisit.match(/^\d+$/)) {
    firstVisit = ''
    localStorage.setItem('firstVisit', currentTime)
    // localStorage.setItem('firstVisit', Date.now())
}
// в строке не только цифры (или переменная пуста)
if(!lastVisit || !lastVisit.match(/^\d+$/)) {
    lastVisit = ''
    localStorage.setItem('lastVisit', currentTime)
    // localStorage.setItem('lastVisit', Date.now())
}
pageViews = Number(pageViews) + 1
localStorage.setItem('pageViews', pageViews)
localStorage.setItem('lastVisit', currentTime)
// localStorage.setItem('lastVisit', Date.now())

document.write('<img src="' + Host + '/stat/?sourceId=9&ref=' + document.referrer + '&current=' + document.location.href + '&screenW=' + window.screen.width + '&screenH=' + window.screen.height + '&userAgent=' + window.navigator.userAgent + '&pageViews=' + pageViews + '&firstVisit=' + firstVisit + '&lastVisit=' + lastVisit + '">')