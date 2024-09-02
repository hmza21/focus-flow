let widths = [600, 768, 992];

function redirect(url) {
    if (!window.location.href.endsWith(url))
        window.location.href = url;
}

function toggleLeftPanel() {

    let container = document.getElementById('content');
    let leftPanel = document.getElementById('left');
    let rightPanel = document.getElementById('right');
    let width = window.innerWidth;
    
    if (width < widths[2]) {
        if (leftPanel.style.display === 'none') {
            leftPanel.style.display = 'inline-block';
            rightPanel.style.display = 'none';
        } else {
            leftPanel.style.display = 'none';
            rightPanel.style.display = 'inline-block';
        }
    } else {
        if (leftPanel.style.display === 'none') {
            leftPanel.style.display = 'inline-block';
            container.style.gridTemplateColumns = '2fr 6fr';
        } else {
            leftPanel.style.display = 'none';
            container.style.gridTemplateColumns = '1fr';
        }
    }

}

function showForm() {
    let noteForm = document.getElementById('note-form');
    let noteButton = document.getElementById('create-note');
    noteForm.style.display = 'flex';
    noteButton.style.display = 'none';
}