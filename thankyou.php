
<!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1.0" /><title>Thankyou</title></head><body><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"><link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet"><div class="thankyou-page"><div class="logo"><a href="https://hydrolinkplumbing.com.au"><img src="https://www.hydrolinkplumbing.com.au/img/logo.webp"></a><h3><i class="fa fa-check" aria-hidden="true"></i><br></h3><p><span>Thank You!</span></p><p class="para">Your submission has been received</p></div></div>
<style>
body {
    margin: 0;
    padding: 0;
	  font-family: "Inter", sans-serif;
}
.thankyou-page {
    width: 70%;
    margin: auto;
    text-align: center;
    box-shadow: 0 1px 6px 0 #20212447;
    display: table;
    margin-top: 4rem;
    padding: 50px 0;
    border-radius: 10px;
}
.thankyou-page .logo {
    float: left;
    width: 100%;
}
.thankyou-page .logo img {
    width: 200px;
}

.thankyou-page  h3 {
    width: 50px;
    margin: auto;
    height: 50px;
    background: #6cb15e;
    border-radius: 50%;
    margin-top: 25px;
}
.thankyou-page h3 i.fa.fa-check {
    color: #fff;
    margin-top: 13px;
    font-size: 25px;
}
.thankyou-page span {
    font-weight: 600;
    font-size: 30px;
}
.thankyou-page p.para {
    margin: 0;
    font-size: 18px;
}

@media (max-width:480px){

.thankyou-page {
    width: 90%;

}
.thankyou-page .logo img {
    width: 150px;
}
.thankyou-page {
    width: 83%;
	    padding: 20px 20px;
}




}
</style>
 <script data-cfasync="false">
  (function () {
    try { window.sophiie?.chat?.destroy?.(); } catch (e) {}
    var loaded = false;
    function init() {
      if (loaded) return;
      loaded = true;
      window.sophiie.chat.load({
        orgId: 'org_2dSoYPLketjxrwpbUn7D7PeNqw9m',
        render: { mode: 'overlay' }
      });
    }
    if (typeof window.sophiie?.chat?.load === 'function') { init(); return; }
    var s = document.createElement('script');
    s.async = true;
    s.type = 'module';
    s.setAttribute('data-cfasync', 'false');
    s.addEventListener('load', function () {
      if (typeof window.sophiie?.chat?.load === 'function') init();
      else console.error('[sophiie] chatbot bundle loaded but did not expose window.sophiie.chat.load');
    });
    s.addEventListener('error', function () { console.error('[sophiie] chatbot bundle failed to load'); });
    s.src = 'https://cdn.sophiie.ai/chatbot/bundle.mjs';
    (document.head || document.documentElement).appendChild(s);
    (function fallback() {
      if (loaded) return;
      if (typeof window.sophiie?.chat?.load === 'function') { init(); return; }
      setTimeout(fallback, 1000);
    })();
  })();
</script>
</body></html>
