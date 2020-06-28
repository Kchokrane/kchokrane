window.onload = () => {
    let icon = document.getElementById('navBar-menu-icon');
    let menu = document.getElementById('navBar-menu');
    let blink = document.getElementById('blink');
    // 
    let active = false,
        blinking = true;
    let style = ["400", "0"],
        image = ["icons8_delete_96px.png", "icons8_menu_96px.png"],
        blinkState = ["visible", "hidden"];
    // Menu show/hide
    icon.addEventListener('click', () => {
        menu.style = `height:${style[+active]}px;`;
        let path = `./res/img/${image[+active]}`;
        if (!blink)
            path = `../img/${image[+active]}`;
        icon.setAttribute('src', path);
        active = !active;
    });
    // Blink
    if (blink) {
        setInterval(() => {
            blink.style.visibility = blinkState[+blinking];
            blinking = !blinking;
        }, 500);
    }
    // NavBar color
    let body = document.getElementsByTagName('body')[0];
    body.addEventListener('scroll', (event) => {
        let currentScroll = event.target.scrollTop;
        if (450 >= currentScroll) {
            let opacity = (currentScroll / 450).toFixed(2);
            setColor(`rgba(0,0,0,${opacity})`);
        } else
            setColor('black')
    });
}
// 
function setColor(color) {
    document.getElementById('Navbar').style = `background-color: ${color}`;
}