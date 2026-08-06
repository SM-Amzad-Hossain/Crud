document.addEventListener('DOMContentLoaded', function() {
 let links = document.querySelectorAll('.delete');
 for ( let i = 0; i < links.length; i++) {
links[i].addEventListener('click', function(event) {
    if (!confirm('Are you sure you want to delete this student?')) {
        event.preventDefault();
    }
});
 }

});