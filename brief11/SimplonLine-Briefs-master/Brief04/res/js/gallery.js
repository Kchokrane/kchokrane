window.onload = () => {
    // 
    const _MENU_OP = () => {
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
    const _SLIDER_SCROLL = (index, lastIndex) => {
        const _IMAGES = document.getElementsByClassName('frame-image');
        const _CONTAINER = document.getElementById('frame-images-container');
        // 
        const _ELEMENT_SCROLL_VALUE = _CONTAINER.scrollWidth / _IMAGES.length;
        const _SCROLL_X = _ELEMENT_SCROLL_VALUE * index;
        // 
        _CONTAINER.scrollTo(_SCROLL_X, 0);
        // 
        _IMAGES[lastIndex].style.backgroundImage = `linear-gradient(#ffffff59, #ffffff59),${_IMAGES[lastIndex].style.backgroundImage}`;
        // 
        _IMAGES[index].style.backgroundImage = `url('../img/gallery/thumbs/bg${index+1}.jpg')`;
        document.getElementById('Landing').style = `background-image: linear-gradient(#04151f33, #04151f33), url('../img/gallery/bg${index+1}.jpg');`;
    }
    // 
    _MENU_OP();
    // 
    let sliderScrollPos = 0,
        lastImagePos = 1;
    document.getElementsByClassName('frame-navigate-btn')[0].addEventListener('click', () => {
        if (sliderScrollPos > 0) {
            lastImagePos = sliderScrollPos;
            sliderScrollPos--;
            _SLIDER_SCROLL(sliderScrollPos, lastImagePos);
        }
    });
    document.getElementsByClassName('frame-navigate-btn')[1].addEventListener('click', () => {
        const _IMAGES_LENGTH = document.getElementsByClassName('frame-image').length;
        if (sliderScrollPos < _IMAGES_LENGTH - 1) {
            lastImagePos = sliderScrollPos;
            sliderScrollPos++;
            _SLIDER_SCROLL(sliderScrollPos, lastImagePos);
        }
    });
}