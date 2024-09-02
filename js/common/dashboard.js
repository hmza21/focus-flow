let widths = [600, 768, 992];

function hidePanel() {
    
    container = document.getElementById('content');
    panel = document.getElementById('right');
    middlePanel = document.getElementById('middle');
    let width = window.innerWidth;
    
    panel = document.getElementById('right');
    let children = panel.children;
    children[0].style.display = 'flex';
    for (let i = 1; i < children.length; i++) {
        children[i].style.display = 'none';
    }

    if (width < widths[2]) {
            
        if (middlePanel.style.display === 'none') {
            middlePanel.style.display = 'inline-block';
            panel.style.display = 'none';
        } else {
            middlePanel.style.display = 'none';
            panel.style.display = 'inline-block';
        }
    }

}

function showPanel() {
    
    container = document.getElementById('content');
    panel = document.getElementById('right');
    middlePanel = document.getElementById('middle');
    let width = window.innerWidth;
    
    let children = panel.children;
    children[0].style.display = 'none';

    if (width < widths[2]) {

        if (middlePanel.style.display === 'none') {
            middlePanel.style.display = 'inline-block';
            panel.style.display = 'none';
        } else {
            middlePanel.style.display = 'none';
            panel.style.display = 'inline-block';
        }

    } else {
    }


    
}

function redirect(url) {
    if (!window.location.href.endsWith(url))
        window.location.href = url;
}

function toggleLeftPanel() {

    let container = document.getElementById('content');
    let leftPanel = document.getElementById('left');
    let middlePanel = document.getElementById('middle');
    let width = window.innerWidth;
    
    if (width < widths[2]) {
        if (leftPanel.style.display === 'none') {
            leftPanel.style.display = 'inline-block';
            middlePanel.style.display = 'none';
        } else {
            leftPanel.style.display = 'none';
            middlePanel.style.display = 'inline-block';
        }
    } else {
        if (leftPanel.style.display === 'none') {
            leftPanel.style.display = 'inline-block';
            container.style.gridTemplateColumns = '2fr 3fr 3fr';
        } else {
            leftPanel.style.display = 'none';
            container.style.gridTemplateColumns = '5fr 3fr';
        }
    }


}