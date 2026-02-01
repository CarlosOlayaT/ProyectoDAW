/**
 * Función para manejar la selección del menú
 */
function selectMenu(element) {
    // 1. Buscamos todos los elementos con la clase nav-item
    const items = document.querySelectorAll('.nav-item');
    
    // 2. Removemos la clase active de todos
    items.forEach(item => {
        item.classList.remove('active');
    });

    // 3. Agregamos la clase active solo al elemento clickeado
    element.classList.add('active');
}