document.addEventListener('mousemove', (e) => {
    var movementStrength = 25;
    var height = movementStrength / window.screen.height;
    var width = movementStrength / window.screen.width;
    // 
    var pageX = e.pageX - (window.screen.width / 2);
    var pageY = e.pageY - (window.screen.height / 2);
    var newvalueX = width * (pageX * -1) - movementStrength;
    var newvalueY = height * (pageY * -1) - movementStrength;
    // 
    document.getElementById('galerie-preview-planet').style.backgroundPositionX = `${10 + newvalueX}px`;
    document.getElementById('galerie-preview-planet').style.backgroundPositionY = `${20 + newvalueY}px`;
    document.body.style.backgroundPositionX = `${newvalueX*2}px`;
    document.body.style.backgroundPositionY = `${newvalueY*2}px`;
});
// 
// 