function hidePanel() {
    panel = document.getElementById('right');
    let children = panel.children;
    children[0].style.display = 'flex';
    for (let i = 1; i < children.length; i++) {
        children[i].style.display = 'none';
    }
}

function showPanel() {
    panel = document.getElementById('right');
    let children = panel.children;
    children[0].style.display = 'none';
    // for (let i = 1; i < children.length; i++) {
    //     children[i].style.display = 'inline';
    // }
}

function redirect(url) {
    if (!window.location.href.endsWith(url))
        window.location.href = url;
}