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
    setText('latest-title', latest.title);
    setText('latest-teaser', latest.teaser);

    const watchUrl = latest.youtubeUrl ||
      (latest.youtubeId ? `https://www.youtube.com/watch?v=${latest.youtubeId}` : 'https://www.youtube.com/@GenXGuideToAI');

    const link = document.getElementById('latest-youtube-link');
    if (link) {
      link.href = watchUrl;
      link.childNodes[0].nodeValue = `WATCH EPISODE ${latest.number} `;
    }

    const embed = document.getElementById('latest-youtube-embed');
    if (embed && latest.youtubeId) {
      embed.src = `https://www.youtube.com/embed/${encodeURIComponent(latest.youtubeId)}?rel=0`;
      embed.title = `Episode ${latest.number} - ${latest.title}`;
    }
  }

  if (next) {
    setText('next-number', `EPISODE ${next.number}`);
    setText('next-title', next.title);
    setText('next-teaser', next.teaser);
  }
})();
