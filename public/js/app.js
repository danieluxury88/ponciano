const topics = [...document.querySelectorAll('.topic')];
const title = document.getElementById('topic-title');
const text = document.getElementById('topic-text');

topics.forEach(button => {
  button.addEventListener('click', () => {
    topics.forEach(item => item.setAttribute('aria-pressed', item === button ? 'true' : 'false'));
    title.textContent = button.dataset.title;
    text.textContent = button.dataset.text;
  });
});

const messagesData = document.getElementById('messages-data');
const messages = messagesData ? JSON.parse(messagesData.textContent) : [];

let current = 0;
const message = document.getElementById('message');
document.getElementById('new-message').addEventListener('click', () => {
  let next = current;
  while (messages.length > 1 && next === current) {
    next = Math.floor(Math.random() * messages.length);
  }
  current = next;
  message.textContent = messages[current];
});
