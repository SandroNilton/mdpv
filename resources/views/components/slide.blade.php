<div class="crossfade">
  <figure></figure>
  <figure></figure>
  <figure></figure>
  <figure></figure>
  <figure></figure>
</div>

<style>
  .crossfade {
    min-height: 100vh;
    position: relative;
  }

  .crossfade:before {
    content: "";
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
  }

  .crossfade > figure {
    animation: imageAnimation 30s linear infinite 0s;
    backface-visibility: hidden;
    position: absolute;
    background-size: cover;
    background-position: center center;
    color: transparent;
    height: 100%;
    left: 0;
    opacity: 0;
    top: 0;
    right: 0;
    z-index: 0;
  }

  .crossfade > figure:nth-child(1) { background-image: url('{{ asset('images/Canta.jpg') }}'); }

  .crossfade > figure:nth-child(2) {
    animation-delay: 6s;
    background-image: url('{{ asset('images/Chosica.jpg') }}');
  }

  .crossfade > figure:nth-child(3) {
    animation-delay: 12s;
    background-image: url('{{ asset('images/Huacho.jpg') }}');
  }

  .crossfade > figure:nth-child(4) {
    animation-delay: 18s;
    background-image: url('{{ asset('images/Huancaya_Yauyos.jpg') }}');
  }

  .crossfade > figure:nth-child(5) {
    animation-delay: 24s;
    background-image: url('{{ asset('images/Barranca.jpg') }}');
  }

@keyframes 
  imageAnimation {  
    0%  {
          animation-timing-function: ease-in;
          opacity: 0;
        }
    8%  {
          animation-timing-function: ease-out;
          opacity: 1;
        }
    17% {
          opacity: 1
        }
    25% {
          opacity: 0
        }
    100% {
          opacity: 0
        } 
  }
</style>