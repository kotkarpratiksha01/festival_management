<?php
// minimal footer include
?>
  </div> <!-- .page-card -->
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
(function(){
  const sidebarSelector = '.sidebar .nav-link';

  function setActive(el){
    document.querySelectorAll(sidebarSelector).forEach(a=>a.classList.remove('active'));
    if(el) el.classList.add('active');
  }

  async function loadPage(url, replace=false){
    try{
      const res = await fetch(url, {credentials:'same-origin'});
      const text = await res.text();
      const parser = new DOMParser();
      const doc = parser.parseFromString(text, 'text/html');

      const newCard = doc.querySelector('.page-card');
      const oldCard = document.querySelector('.page-card');
      if(newCard && oldCard){
        oldCard.replaceWith(newCard);
      } else {
        const newContent = doc.querySelector('.content');
        if(newContent){
          document.querySelector('.content').innerHTML = newContent.innerHTML;
        } else {
          console.warn('No .page-card or .content in response for', url);
        }
      }

      if(!replace){
        history.pushState({url:url}, '', url);
      }
      window.scrollTo({top:0,behavior:'smooth'});
    }catch(err){
      console.error('loadPage error', err);
      alert('Failed to load page. See console.');
    }
  }

  document.addEventListener('click', function(e){
    const a = e.target.closest(sidebarSelector);
    if(!a) return;
    if(a.hostname !== location.hostname || e.metaKey || e.ctrlKey || e.shiftKey || e.altKey) return;
    e.preventDefault();
    setActive(a);
    loadPage(a.href);
  });

  window.addEventListener('popstate', function(){
    loadPage(location.href, true);
  });

  document.addEventListener('DOMContentLoaded', function(){
    const cur = location.pathname.split('/').pop() || 'dashboard.php';
    const link = Array.from(document.querySelectorAll(sidebarSelector)).find(a=>{
      const href = a.getAttribute('href');
      return href === cur || a.href === location.href;
    });
    if(link) setActive(link);
  });
})();
</script>
</body>
</html>