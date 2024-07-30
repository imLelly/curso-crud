 class Index extends HTMLElement {
    connectedCallback() {
        fetch('./index.html')
        .then(response => response.text())
        .then(html => this.innerHTML = html)
    }
 }
 window.customElements.define('nav-bar', Index)