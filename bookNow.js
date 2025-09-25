
window.addEventListener('DOMContentLoaded', () => {
  // Create popup once
  const popup = document.createElement('div');
  popup.id = 'popup-message';
  popup.className = 'fixed bottom-6 right-6 text-white px-4 py-2 rounded shadow-md text-sm opacity-0 transition-opacity duration-300 z-50';
  document.body.appendChild(popup);

  function showPopup(message, isError = false) {
    popup.innerText = message;
    popup.classList.remove('opacity-0');
    popup.classList.add('opacity-100');
    popup.classList.remove('bg-green-600', 'bg-red-600');
    popup.classList.add(isError ? 'bg-red-600' : 'bg-green-600');

    setTimeout(() => {
      popup.classList.remove('opacity-100');
      popup.classList.add('opacity-0');
    }, 3000);
  }

  // Select all Book Now buttons (not disabled)
  const bookNowButtons = Array.from(document.querySelectorAll('button'))
    .filter(btn => btn.textContent.trim().toLowerCase() === 'book now' && !btn.disabled);

  bookNowButtons.forEach(button => {
    button.addEventListener('click', (e) => {
      e.preventDefault();
      // Find available slots info in the same card
      const card = button.closest('.p-6');
      let slots = 1; // Default to 1 if not found
      if (card) {
        const slotParagraph = Array.from(card.querySelectorAll('p'))
          .find(p => p.textContent.toLowerCase().includes('available slots'));
        if (slotParagraph) {
          const match = slotParagraph.textContent.match(/Available Slots:\s*(\d+)/i);
          slots = match ? parseInt(match[1], 10) : 0;
        }
      }
      if (slots === 0) {
        showPopup('No slots available', true);
      } else {
        showPopup('Booking confirmed!', false);
      }
    });
  });

  // Also handle disabled Book Now buttons for full slots
  const disabledBookNowButtons = Array.from(document.querySelectorAll('button[disabled]'))
    .filter(btn => btn.textContent.trim().toLowerCase() === 'book now');
  disabledBookNowButtons.forEach(button => {
    button.addEventListener('click', (e) => {
      e.preventDefault();
      showPopup('No slots available', true);
    });
  });
});
