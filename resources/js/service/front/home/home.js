// Basic JavaScript functionality for demonstration
document.addEventListener('DOMContentLoaded', function() {
    // Set default dates
    const today = new Date();
    const tomorrow = new Date(today);
    tomorrow.setDate(tomorrow.getDate() + 1);
    
    const nextWeek = new Date(today);
    nextWeek.setDate(today.getDate() + 7);
    
    // Format dates for input fields
    const formatDate = (date) => {
        const year = date.getFullYear();
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const day = String(date.getDate()).padStart(2, '0');
        return `${year}-${month}-${day}`;
    };
    
    document.getElementById('departure-date').value = formatDate(tomorrow);
    document.getElementById('return-date').value = formatDate(nextWeek);
    
    // Form submission
    document.querySelector('.search-form').addEventListener('submit', function(e) {
        e.preventDefault();
        alert('Pencarian tiket berhasil! Ini hanya demonstrasi UI.');
    });
    
    // Hamburger menu for mobile
    document.querySelector('.hamburger').addEventListener('click', function() {
        const navLinks = document.querySelector('.nav-links');
        navLinks.style.display = navLinks.style.display === 'flex' ? 'none' : 'flex';
    });
});