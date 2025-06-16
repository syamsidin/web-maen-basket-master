window.addEventListener('load', updateHeaderNavHeight);
window.addEventListener('resize', updateHeaderNavHeight);

var headerNavElement = document.querySelector('.navbar-banner');
var headerNavStyleElement = document.createElement('style');
headerNavElement.appendChild(headerNavStyleElement);

function updateHeaderNavHeight()
{
	var h = headerNavElement.offsetHeight;
    console.log(h)
	
	headerNavStyleElement.innerText = '#navigation-banner::before { height:' + h + 'px; }'
		+ '#navigation-banner { margin-bottom:' + (-h) + 'px }';
}