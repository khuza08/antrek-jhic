import { useState, useEffect } from 'react';

const TOTAL_IMAGES = 5; // sesuaikan dengan jumlah file smk*.webp

const getRandomIndex = () => Math.floor(Math.random() * TOTAL_IMAGES) + 1;

export default function Hero() {
  const [bgIndex, setBgIndex] = useState(getRandomIndex());

  useEffect(() => {
    const interval = setInterval(() => {
      setBgIndex(getRandomIndex());
    }, 1500); // 1.5 detik

    return () => clearInterval(interval); // cleanup
  }, []);

  const bgImage = `/images/smk${bgIndex}.webp`;

  return (
    <section className="relative flex items-center justify-center bg-white dark:bg-gray-800 px-4 py-12 sm:py-16 md:p-8 w-full min-h-screen md:h-screen overflow-hidden">
      {/* Background Image - Rotates every 1.5s */}
      <img
        key={bgIndex} // penting agar img benar-benar re-render saat src berubah
        src={bgImage}
        alt="SMK Antartika 2 Sidoarjo"
        className="absolute inset-0 w-full h-full object-cover object-center filter brightness-20 rounded-b-4xl transition-opacity duration-500"
        onError={(e) => {
          e.target.src = '/images/smk1.webp';
        }}
      />

      {/* Main Content */}
      <div className="relative flex flex-col items-center max-w-4xl w-full gap-3 sm:gap-4 md:gap-6 text-center z-10 px-2 sm:px-4">
        <p className="text-xs sm:text-sm md:text-xl text-white/80 font-mono leading-tight">
          Selamat Datang Di <span className='font-inter font-semibold text-white'>SMK ANTARTIKA 2 SIDOARJO</span>
        </p>

        <h1 className="text-2xl sm:text-4xl md:text-5xl lg:text-6xl font-semibold text-white font-inter leading-snug sm:leading-tight md:leading-none tracking-tight">
          Meet New <span className='italic font-extralight text-blue-600 dark:text-blue-400' style={{ fontFamily: "'Instrument Serif', serif" }}>Friends</span> and <br className="hidden sm:block" />Learn from Experts.
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