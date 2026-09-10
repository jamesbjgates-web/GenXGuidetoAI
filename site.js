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
    const watchUrl = latest.youtubeUrl ||
      (latest.youtubeId ? `https://www.youtube.com/watch?v=${latest.youtubeId}` : 'https://www.youtube.com/@GenXGuideToAI');

    const visualLink = document.getElementById('latest-youtube-visual-link');
    if (visualLink) {
      visualLink.href = watchUrl;
      visualLink.setAttribute('aria-label', `Watch Episode ${latest.number} on YouTube`);
    }

    const poster = document.getElementById('latest-episode-poster');
    if (poster) {
      poster.alt = `Episode ${latest.number} - ${latest.title}`;
      if (latest.poster) poster.src = latest.poster;
    }
  }

  if (next) {
    setText('next-number', `EPISODE ${next.number}`);
    setText('next-title', next.title);
    setText('next-teaser', next.teaser);
  }
})();
