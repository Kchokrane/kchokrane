let globalID;
window.onload = () => {
    menuOp();
    // fill first slider
    const _IMAGE_PATH = "./res/img/I-slider";
    const _NAMES = ["Dubai", "Abu dhabi", "Ras al khaimah", "sharjah", "Fujairah"];
    const _SLIDES = document.getElementsByClassName('part1-slide');
    const _SLIDES_TITLES = document.getElementsByClassName('part1-slide-title');
    for (let i = 0; i < _SLIDES.length; i++) {
        _SLIDES[i].style = `background-image: url('${_IMAGE_PATH}${i + 1}.png');`;
        _SLIDES_TITLES[i].innerText = _NAMES[i];
    }
    // 
    const _IMG = _SLIDES[0].style.backgroundImage;
    const _STYLE = `background-image:${_IMG};height: 525px;box-shadow: 0px -5px 20px rgba(0, 0, 0, 0.25);z-index: 1;`;
    // _SLIDES[0].style = _STYLE;
    // Slider
    /*const _SLIDER = document.getElementById('part1-slideshow');
    const _MAX_SCROLL_LEFT = _SLIDER.scrollWidth - _SLIDER.clientWidth;
    const _SCROLL_VALUE = (_MAX_SCROLL_LEFT / _SLIDES.length);*/
    // Slider Navigation
    let pos = 0;
    const _MAXPOS = _SLIDES.length;
    const _NAV_BACK = document.getElementById('part1-nav-prev');
    const _NAV_NEXT = document.getElementById('part1-nav-next');
    // 
    _NAV_BACK.addEventListener('click', () => {
        pos > 0 ? pos-- : pos = 0;
        changeFocused(pos);
    });
    _NAV_NEXT.addEventListener('click', () => {
        pos < _MAXPOS - 1 ? pos++ : pos = _MAXPOS - 1;
        changeFocused(pos);
    });
    // 
    // 
    // Second navigation
    const _IMGS_PATH = "./res/img/II-slider";
    const _VISUAL = document.getElementById('part2-img-visualizer');
    _VISUAL.style = `background-image: url('${_IMGS_PATH}${1}.png');`;
    const _IMGS = document.getElementsByClassName('part2-img');
    for (let i = 1; i <= _IMGS.length; i++) {
        _IMGS[i - 1].style = `background-image: url('${_IMGS_PATH}${i + 1}.png');`;
        // _SLIDES_TITLES[i].innerText = _NAMES[i];
    }
    const _NAVIGATE_BACK = document.getElementById('part2-contex-back');
    const _NAVIGATE_NEXT = document.getElementById('part2-contex-forw');
    let cPos = -1;
    let arrrr = "zzz";
    let yt = ["A", "B", "C", "D"];
    _NAVIGATE_BACK.addEventListener('click', () => {
        cPos > 0 ? cPos++ : cPos = _IMGS.length - 1;
        switchFocus(cPos, yt, arrrr, false);
    });
    _NAVIGATE_NEXT.addEventListener('click', () => {
        cPos < _IMGS.length - 1 ? cPos++ : cPos = 0;
        switchFocus(cPos, yt, arrrr, true);
        // arrrr = res[0];
        // yt = res[1];
    });
    // 
    // 
    const _VIDEO_SLIDES = document.getElementsByClassName('part5-slide');
    const _SLIDER = document.getElementById('part5-slider');
    const _SCROLL_VALUE = _SLIDER.scrollWidth / _VIDEO_SLIDES.length;
    console.log([_SLIDER.scrollWidth, window.scrollY]);
    // window.scrollTo(_SLIDER.scrollWidth, window.scrollY);
    // _SLIDER.scrollTo(_SLIDER.scrollWidth, window.scrollY);
    globalID = requestAnimationFrame(repeatOften);
    // 
    _SLIDER.addEventListener('mouseenter', () => {
        // console.log("in");
        // console.log([allowed, lastX, animationSteps]);
        allowed = false;
        cancelAnimationFrame(globalID);
    });
    _SLIDER.addEventListener('mouseleave', () => {
        // console.log("out");
        // console.log([allowed, lastX, animationSteps]);
        allowed = true;
        globalID = requestAnimationFrame(repeatOften);
    });

    // console.log([_MAX_SCROLL_LEFT, _VIDEO_SLIDES.length])
    // console.log([_SCROLL_VALUE, _SLIDER.scrollWidth, _VIDEO_SLIDES.length, (_MAX_SCROLL_LEFT / _VIDEO_SLIDES.length)]);

}
// 
function changeFocused(pos) {
    const _NAV_BACK = document.getElementById('part1-nav-prev');
    const _NAV_NEXT = document.getElementById('part1-nav-next');
    // 
    const _SLIDES = document.getElementsByClassName('part1-slide');
    const _IMG = _SLIDES[pos].style.backgroundImage;
    const _STYLE = `background-image:${_IMG};height: 525px;box-shadow: 0px -5px 20px rgba(0, 0, 0, 0.25);z-index: 1;`;
    _SLIDES[pos].style = _STYLE;
    for (let i = 0; i < _SLIDES.length; i++) {
        if (i != pos) {
            let img = _SLIDES[i].style.backgroundImage;
            let style = `background-image: ${img};`;
            _SLIDES[i].style = style;
        }
    }
    // 
    let hrefs = [_NAV_BACK.getAttribute('href'), _NAV_NEXT.getAttribute('href')]
    let minRefs = [hrefs[0].slice(0, hrefs[0].length - 1), hrefs[1].slice(0, hrefs[1].length - 1)];
    pos++;
    _NAV_BACK.setAttribute('href', (minRefs[0] + pos));
    _NAV_NEXT.setAttribute('href', (minRefs[1] + pos));
}
// 
function switchFocus(pos, array, ref, state) {
    // console.log(pos);
    const _IMGS = document.getElementsByClassName('part2-img');
    const _VISUAL = document.getElementById('part2-img-visualizer');
    //
    const _IMG = _VISUAL.style.backgroundImage;
    // 
    let placeholder;
    if (state) {
        placeholder = _IMGS[0].style.backgroundImage;
        for (let i = 0; i < _IMGS.length - 1; i++) {
            _IMGS[i].style.backgroundImage = _IMGS[i + 1].style.backgroundImage;
        }
        _IMGS[_IMGS.length - 1].style.backgroundImage = _IMG;
        _VISUAL.style.backgroundImage = placeholder;
    } else {
        placeholder = _IMGS[_IMGS.length - 1].style.backgroundImage;
        for (let i = _IMGS.length - 1; i > 0; i--) {
            _IMGS[i].style.backgroundImage = _IMGS[i - 1].style.backgroundImage;
        }
        _IMGS[0].style.backgroundImage = _IMG;
        _VISUAL.style.backgroundImage = placeholder;

    }
    // console.log([ref, array]);
    // console.log(array);
    // return [ref, array];
}
// 
let lastX = 0;
let allowed = true;
let animationSteps = 0;
let animationDirection = true;

function repeatOften() {
    const _SLIDER = document.getElementById('part5-slider');
    if (allowed) {
        setTimeout(() => {
            _SLIDER.scrollTo(animationSteps, window.scrollY);
            if (_SLIDER.scrollLeft >= 967) {
                animationDirection = false;
                animationSteps = 0;
            } else if (_SLIDER.scrollLeft <= 0) {
                animationDirection = true;
                animationSteps = 0;
            }
            animationDirection ? animationSteps = animationSteps + 1 : animationSteps = animationSteps - 2;
            lastX = _SLIDER.scrollLeft;
            // console.log(lastX);
            globalID = requestAnimationFrame(repeatOften);
        }, 40);
    } else {
        // console.log(lastX);
        //     // animationSteps = lastX;
        _SLIDER.scrollTo(animationSteps, window.scrollY);
    }
}
// 
// 
function menuOp() {
    const _MENU_CLOSE = document.getElementById('nav-close');
    const _MENU_OPEN = document.getElementById('nav-menu-icon');
    const _MENU = document.getElementById('nav-menu');
    // 
    let state = false;
    // 
    _MENU_OPEN.addEventListener('click', () => {
        if (!state) {
            _MENU.style.display = "flex";
            state = true;
        }
    });
    _MENU_CLOSE.addEventListener('click', () => {
        if (state) {
            _MENU.style.display = "none";
            state = false;
        }
    });
}