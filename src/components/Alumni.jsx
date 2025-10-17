import { useEffect, useState } from 'react';
import SectionTitle from './sectionTitle';
import Marquee from 'react-fast-marquee';

export default function Alumni() {
  const testimonials = [
    {
      name: "Budi Santoso",
      role: "Alumni 2015",
      message:
        "Sekolah ini memberikan banyak pengalaman berharga, tidak hanya akademik tetapi juga pengembangan karakter. Saya sangat berterima kasih kepada para guru.",
      img: "https://randomuser.me/api/portraits/men/32.jpg",
    },
    {
      name: "Siti Aisyah",
      role: "Alumni 2018",
      message:
        "Lingkungan belajar yang nyaman dan guru yang peduli membuat saya merasa seperti di rumah sendiri. Ilmu yang saya dapatkan sangat bermanfaat di dunia kerja.",
      img: "https://randomuser.me/api/portraits/women/44.jpg",
    },
    {
      name: "Andi Wijaya",
      role: "Alumni 2020",
      message:
        "Kegiatan ekstrakurikuler di sini membantu saya menemukan minat dan bakat yang akhirnya menjadi karir saya sekarang.",
      img: "https://randomuser.me/api/portraits/men/65.jpg",
    },
    {
      name: "Rahma Putri",
      role: "Alumni 2017",
      message:
        "Belajar di sini membuat saya siap menghadapi tantangan di perguruan tinggi. Dukungan guru sangat luar biasa.",
      img: "https://randomuser.me/api/portraits/women/68.jpg",
    },
    {
      name: "Dewi Kartika",
      role: "Alumni 2016",
      message:
        "Selain akademik, saya mendapatkan banyak soft skill yang sangat berguna di dunia kerja.",
      img: "https://randomuser.me/api/portraits/women/25.jpg",
    },
    {
      name: "Fajar Pratama",
      role: "Alumni 2019",
      message:
        "Sekolah ini memberikan banyak kesempatan untuk berkembang dan berprestasi.",
      img: "https://randomuser.me/api/portraits/men/14.jpg",
    },
  ];

  const duplicated = [...testimonials, ...testimonials];
  const mid = duplicated.length / 2;
  const firstRow = duplicated.slice(0, mid);
  const secondRow = duplicated.slice(mid);

  const Card = ({ alumni }) => (
    <div className="bg-white dark:bg-slate-800 rounded-xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-200 dark:border-slate-700 flex flex-col h-full mx-4 w-80 flex-shrink-0">
      <div className="flex items-center mb-4">
        <img
          src={alumni.img.trim()}
          alt={alumni.name}
          className="w-16 h-16 rounded-full object-cover mr-4 border-2 border-blue-500 dark:border-blue-400"
        />
        <div>
          <h3 className="text-blue-600 dark:text-blue-400 font-semibold text-lg">{alumni.name}</h3>
          <p className="text-sm text-gray-600 dark:text-slate-300">{alumni.role}</p>
        </div>
      </div>
      <div className="flex-grow">
        <p className="text-gray-700 dark:text-slate-300 line-clamp-5">
          "{alumni.message}"
        </p>
      </div>
      <div className="mt-4 flex justify-end">
        <svg className="w-8 h-8 text-blue-500 dark:text-blue-400 opacity-50" fill="currentColor" viewBox="0 0 24 24">
          <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z" />
        </svg>
      </div>
    </div>
  );

  const [gradientColor, setGradientColor] = useState('#dbeafe');

  useEffect(() => {
    const mediaQuery = window.matchMedia('(prefers-color-scheme: dark)');

    const updateTheme = () => {
      const isDark = mediaQuery.matches;
      setGradientColor(isDark ? '#0e172b' : '#dbeafe');
    };

    updateTheme();

    mediaQuery.addEventListener('change', updateTheme);

    return () => mediaQuery.removeEventListener('change', updateTheme);
  }, []);

  return (
    <section className="w-full min-h-screen bg-blue-100 dark:bg-slate-900 py-16 overflow-hidden">
      <div className="max-w-7xl mx-auto px-4 w-full">
        <div className="text-center py-4 mb-12">
          <SectionTitle>
            Apa Kata <span className="italic text-blue-600 dark:text-blue-400" style={{ fontFamily: "'Instrument Serif', serif" }}>
              Alumni?
            </span>
          </SectionTitle>
          <p className="mt-4 text-gray-600 dark:text-slate-300 max-w-2xl mx-auto">
            Testimoni jujur dari alumni kami tentang pengalaman mereka selama bersekolah di sini
          </p>
        </div>

        {/* First row: left to right */}
        <Marquee
          speed={30}
          pauseOnHover
          gradient={true}
          gradientWidth={100}
          gradientColor={gradientColor}
          className="mb-6"
        >
          {firstRow.map((alumni, i) => (
            <Card key={`row1-${i}`} alumni={alumni} />
          ))}
        </Marquee>

        {/* Second row: right to left */}
        <Marquee
          speed={30}
          pauseOnHover
          gradient={true}
          gradientWidth={100}
          gradientColor={gradientColor}
          direction="right"
        >
          {secondRow.map((alumni, i) => (
            <Card key={`row2-${i}`} alumni={alumni} />
          ))}
        </Marquee>


      </div>
    </section>
  );
}