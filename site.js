(() => {
  const data = window.GENX_EPISODES;
  if (!data) return;

  const setText = (id, value) => {
    const el = document.getElementById(id);
    if (el && value != null) el.textContent = value;
  };

  const latest = data.latest;
  const next = data.next;

  if (latest) {
    const number = `EPISODE ${latest.number}`;
    setText('latest-number', number);
    setText('latest-video-number', number);
    setText('latest-title', latest.title);
    setText('latest-video-title', latest.title);
    setText('latest-teaser', latest.teaser);

    const link = document.getElementById('latest-youtube-link');
    if (link) {
      link.href = latest.youtubeUrl || 'https://www.youtube.com/@GenXGuideToAI';
      link.childNodes[0].nodeValue = `WATCH EPISODE ${latest.number} `;
    }
  }

  if (next) {
    setText('next-number', `EPISODE ${next.number}`);
    setText('next-title', next.title);
    setText('next-teaser', next.teaser);
  }
})();
