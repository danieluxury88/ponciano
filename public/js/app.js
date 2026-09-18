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
const messageRef = document.getElementById('message-ref');
const newMessageButton = document.getElementById('new-message');

const showNextMessage = () => {
  let next = current;
  while (messages.length > 1 && next === current) {
    next = Math.floor(Math.random() * messages.length);
  }
  current = next;
  message.textContent = messages[current].text;
  if (messageRef) {
    messageRef.textContent = messages[current].ref;
  }
};

if (message && messages.length > 1) {
  const MESSAGE_INTERVAL_MS = 10000;
  let rotation = setInterval(showNextMessage, MESSAGE_INTERVAL_MS);

  if (newMessageButton) {
    newMessageButton.addEventListener('click', () => {
      showNextMessage();
      clearInterval(rotation);
      rotation = setInterval(showNextMessage, MESSAGE_INTERVAL_MS);
    });
  }
}

const calendarEl = document.getElementById('calendar');
if (calendarEl) {
  const calendarDataEl = document.getElementById('calendar-data');
  const events = calendarDataEl ? JSON.parse(calendarDataEl.textContent) : {};

  const [startYear, startMonth] = calendarEl.dataset.start.split('-').map(Number);
  const [endYear, endMonth] = calendarEl.dataset.end.split('-').map(Number);
  const startIndex = startYear * 12 + (startMonth - 1);
  const endIndex = endYear * 12 + (endMonth - 1);

  const monthNames = ['enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'];

  const now = new Date();
  let viewIndex = now.getFullYear() * 12 + now.getMonth();
  if (viewIndex < startIndex) viewIndex = startIndex;
  if (viewIndex > endIndex) viewIndex = endIndex;

  const grid = document.getElementById('calendar-grid');
  const calendarTitle = document.getElementById('calendar-title');
  const prevBtn = document.getElementById('calendar-prev');
  const nextBtn = document.getElementById('calendar-next');
  const detailTitle = document.getElementById('calendar-detail-title');
  const detailText = document.getElementById('calendar-detail-text');

  const pad = n => String(n).padStart(2, '0');

  const showDetail = (dateKey, dayEvents) => {
    const [, m, d] = dateKey.split('-').map(Number);
    detailTitle.textContent = `${d} de ${monthNames[m - 1]}`;
    detailText.textContent = '';
    dayEvents.forEach(ev => {
      const block = document.createElement('div');
      const strong = document.createElement('strong');
      strong.className = 'calendar-event-title';
      strong.textContent = ev.title;
      const p = document.createElement('div');
      p.textContent = ev.text;
      block.appendChild(strong);
      block.appendChild(p);
      detailText.appendChild(block);
    });
  };

  const renderCalendar = () => {
    const year = Math.floor(viewIndex / 12);
    const month = viewIndex % 12;

    calendarTitle.textContent = `${monthNames[month]} ${year}`;
    prevBtn.disabled = viewIndex <= startIndex;
    nextBtn.disabled = viewIndex >= endIndex;

    grid.textContent = '';

    const firstOfMonth = new Date(year, month, 1);
    const startOffset = (firstOfMonth.getDay() + 6) % 7;
    const daysInMonth = new Date(year, month + 1, 0).getDate();

    for (let i = 0; i < startOffset; i++) {
      const filler = document.createElement('span');
      filler.className = 'calendar-day is-outside';
      grid.appendChild(filler);
    }

    for (let day = 1; day <= daysInMonth; day++) {
      const dateKey = `${year}-${pad(month + 1)}-${pad(day)}`;
      const dayEvents = events[dateKey];
      const isToday = now.getFullYear() === year && now.getMonth() === month && now.getDate() === day;

      const cell = document.createElement(dayEvents ? 'button' : 'div');
      cell.className = 'calendar-day';
      if (dayEvents) {
        cell.type = 'button';
        cell.classList.add('has-event');
      }
      if (isToday) cell.classList.add('is-today');

      const num = document.createElement('span');
      num.textContent = String(day);
      cell.appendChild(num);

      if (dayEvents) {
        const dots = document.createElement('span');
        dots.className = 'dots';
        dayEvents.forEach(ev => {
          const dot = document.createElement('span');
          dot.className = ev.type === 'caritas' ? 'dot dot--caritas' : 'dot';
          dots.appendChild(dot);
        });
        cell.appendChild(dots);

        cell.addEventListener('click', () => {
          grid.querySelectorAll('.calendar-day.is-selected').forEach(el => el.classList.remove('is-selected'));
          cell.classList.add('is-selected');
          showDetail(dateKey, dayEvents);
        });
      }

      grid.appendChild(cell);

      if (isToday && dayEvents) {
        cell.classList.add('is-selected');
        showDetail(dateKey, dayEvents);
      }
    }
  };

  prevBtn.addEventListener('click', () => {
    if (viewIndex > startIndex) {
      viewIndex -= 1;
      renderCalendar();
    }
  });
  nextBtn.addEventListener('click', () => {
    if (viewIndex < endIndex) {
      viewIndex += 1;
      renderCalendar();
    }
  });

  renderCalendar();
}
