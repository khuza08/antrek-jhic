import { useState, useEffect } from 'react';

const TOTAL_IMAGES = 5; // sesuaikan

export default function Hero() {
  const [currentImage, setCurrentImage] = useState(1);
  const [nextImage, setNextImage] = useState(2);

  useEffect(() => {
    const interval = setInterval(() => {
      const newImage = Math.floor(Math.random() * TOTAL_IMAGES) + 1;
      setCurrentImage(nextImage);
      setNextImage(newImage);
    }, 4096);

    return () => clearInterval(interval);
  }, [nextImage]);

  return (
    <section className="relative flex items-center justify-center bg-white dark:bg-gray-800 px-4 py-12 sm:py-16 md:p-8 w-full min-h-screen md:h-screen overflow-hidden">
      {/* Background Images with fade */}
      <div className="absolute inset-0">
        {/* Gambar aktif (di belakang) */}
        <img
          src={`/images/smk${currentImage}.webp`}
          alt="SMK Antartika 2 Sidoarjo"
          className="absolute inset-0 w-full h-full object-cover object-center filter brightness-20 rounded-b-4xl"
          onError={(e) => (e.target.src = '/images/smk1.webp')}
        />
        {/* Gambar berikutnya (di depan, fade in) */}
        <img
          key={nextImage}
          src={`/images/smk${nextImage}.webp`}
          alt="SMK Antartika 2 Sidoarjo"
          className="absolute inset-0 w-full h-full object-cover object-center filter brightness-20 rounded-b-4xl opacity-0 transition-opacity duration-900"
          onLoad={(e) => {
            // Fade in setelah gambar selesai load
            e.currentTarget.classList.remove('opacity-0');
            e.currentTarget.classList.add('opacity-100');
          }}
          onError={(e) => (e.target.src = '/images/smk1.webp')}
        />
      </div>

      {/* Main Content */}
      <div className="relative flex flex-col items-center max-w-4xl w-full gap-3 sm:gap-4 md:gap-6 text-center z-10 px-2 sm:px-4">
        <p className="text-xs sm:text-sm md:text-xl text-white/80 font-mono leading-tight">
          Selamat Datang Di <span className='font-inter font-semibold text-white'>SMK ANTARTIKA 2 SIDOARJO</span>
        </p>

        <h1 className="text-2xl sm:text-4xl md:text-5xl lg:text-6xl font-semibold text-white font-inter leading-snug sm:leading-tight md:leading-none tracking-tight">
          Sekolahnya Sang <span className='italic font-extralight text-blue-600 dark:text-blue-400' style={{ fontFamily: "'Instrument Serif', serif" }}>Juara</span>  <br className="hidden sm:block" />
        </h1>

        <div className="flex flex-col sm:flex-row gap-3 sm:gap-4 mt-4 w-full sm:w-auto">
          <button className="bg-blue-600 dark:bg-blue-500 text-white font-semibold px-4 py-2 sm:px-6 sm:py-3 rounded-full hover:bg-blue-700 dark:hover:bg-blue-600 transition text-sm sm:text-base w-full sm:w-auto">
            Tentang Kami
          </button>
          <button className="bg-transparent backdrop-blur-lg border border-blue-400 text-blue-400 font-semibold px-4 py-2 sm:px-6 sm:py-3 rounded-full hover:bg-blue-500/50 hover:text-white transition text-sm sm:text-base w-full sm:w-auto">
            Kontak Kami
          </button>
        </div>
      </div>
    </section>
  );
}