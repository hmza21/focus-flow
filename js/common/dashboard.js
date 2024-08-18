function hidePanel(panel) {
    panel = document.getElementById(panel);
    let children = panel.children;
    children[0].style.display = 'flex';
    for (let i = 1; i < children.length; i++) {
        children[i].style.display = 'none';
    }
    event.preventDefault();
}

function redirect(url) {
    if (!window.location.href.endsWith(url))
        window.location.href = url;
}

function showPanel(panel) {
    panel = document.getElementById(panel);
    let children = panel.children;
    children[0].style.display = 'none';
    for (let i = 1; i < children.length; i++) {
        children[i].style.display = 'inline';
    }
    event.preventDefault();
}