const menuBtn = document.querySelector('.nav--menu')
const navLinks = document.querySelector('.nav--links__mobile')
const navItems = document.querySelectorAll('.nav--links__mobile a')

menuBtn.addEventListener('click', () => {
	navLinks.classList.toggle('show')
})

navItems.forEach(navItem => {
	navItem.addEventListener('click', () => {
		navLinks.classList.remove('show')
	})
})
