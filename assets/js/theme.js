
const headerMobileToggle = document.querySelector('.wit-header-mobile-toggle')

headerMobileToggle?.addEventListener('click', function() {
  const headerLower = document.querySelector('.wit-header-lower')
  headerLower.classList.toggle('active')
})