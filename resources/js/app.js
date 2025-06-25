import './bootstrap';

// Función para generar iniciales del usuario
function generateUserInitials() {
    // Obtener el nombre completo del usuario desde el dropdown-title
    const dropdownTitle = document.querySelector('.dropdown-title');
    if (dropdownTitle) {
        const fullText = dropdownTitle.textContent.trim();
        // Extraer solo el nombre (quitar "Hello " del inicio)
        const userName = fullText.replace(/^Hello\s+/i, '');
        
        // Dividir el nombre en palabras
        const nameParts = userName.split(' ').filter(part => part.length > 0);
        
        // Generar iniciales (máximo 2 letras)
        let initials = '';
        if (nameParts.length >= 2) {
            // Tomar primera letra del primer nombre y primera letra del primer apellido
            initials = nameParts[0].charAt(0).toUpperCase() + nameParts[1].charAt(0).toUpperCase();
        } else if (nameParts.length === 1) {
            // Si solo hay un nombre, tomar las primeras dos letras
            initials = nameParts[0].substring(0, 2).toUpperCase();
        } else {
            // Fallback
            initials = 'US';
        }
        
        // Actualizar el elemento de iniciales
        const userInitialsElement = document.getElementById('userInitials');
        if (userInitialsElement) {
            userInitialsElement.textContent = initials;
        }
    }
}

// Ejecutar cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', generateUserInitials);
