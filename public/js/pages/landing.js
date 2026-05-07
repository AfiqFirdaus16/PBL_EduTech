// Toggle FAQ
function toggleFaq(event) {
    event.preventDefault();
    const button = event.target.closest('.faq-button');
    const faqItem = button.closest('.faq-item');
    const answer = faqItem.querySelector('.faq-answer');
    
    // Tutup semua FAQ lain
    document.querySelectorAll('.faq-item').forEach(item => {
        if (item !== faqItem) {
            item.classList.remove('active');
            item.querySelector('.faq-answer').style.display = 'none';
        }
    });
    
    // Toggle FAQ yang diklik
    faqItem.classList.toggle('active');
    answer.style.display = answer.style.display === 'none' ? 'block' : 'none';
}

// Smooth scroll untuk anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({ behavior: 'smooth' });
        }
    });
});