export default function News() {
  const news = [
    {
      img: "https://picsum.photos/800/600?random=1",
      category: "Miscellaneous",
      title: "Punk rocker with a PhD: The Offspring's Dexter Holland is also a virologist",
      date: "May 15, 2023"
    },
    {
      img: "https://picsum.photos/800/600?random=2",
      category: "Supporting Veterans",
      title: "USC Master of Business for Veterans program helps combat medic give back",
      date: "April 28, 2023"
    },
    {
      img: "https://picsum.photos/800/600?random=3",
      category: "Space Research",
      title: "Alum connects NASA space research to earthbound lawmakers",
      date: "April 15, 2023"
    },
    {
      img: "https://picsum.photos/800/600?random=4",
      category: "Public Service",
      title: "New City Council member credits time at USC for inspiring his run for office",
      date: "March 30, 2023"
    },
    {
      img: "https://picsum.photos/800/600?random=5",
      category: "Aging Research",
      title: "Rethinking the study of Black health and aging",
      date: "March 15, 2023"
    },
    {
      img: "https://picsum.photos/800/600?random=6",
      category: "Education",
      title: "New scholarship program helps underprivileged students access education",
      date: "February 28, 2023"
    },
  ];

  return (
    <section className="w-full bg-gradient-to-b from-white to-blue-100 dark:from-slate-800 dark:to-slate-900 py-16">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="text-center mb-12">
          <h2 className="text-3xl font-bold text-gray-800 dark:text-white mb-4" data-aos="fade-in">
            Berita <span className="italic text-blue-600 dark:text-blue-400" style={{ fontFamily: "'Instrument Serif', serif" }}>Terbaru</span>
          </h2>
          <p className="text-gray-600 dark:text-slate-300 max-w-2xl mx-auto" data-aos="fade-in">
            Ikuti perkembangan terbaru dan cerita inspiratif dari komunitas kami
          </p>
        </div>

        {/* atas */}
        <div className="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
          {news.slice(0, 3).map((item, i) => (
            <NewsCard key={i} item={item} />
          ))}
        </div>

        {/* bawah*/}
        <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
          {news.slice(3, 6).map((item, i) => (
            <NewsCard key={i+3} item={item} />
          ))}
        </div>

        <div className="text-center mt-12">
          <button className="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-full transition duration-200 shadow-lg hover:shadow-blue-500/20">
            Lihat Semua Berita
          </button>
        </div>
      </div>
    </section>
  );
}

function NewsCard({ item }) {
  return (
    <div className="group relative overflow-hidden rounded-xl shadow-lg h-80 hover:shadow-xl transition-shadow duration-300">
      <img
        src={item.img}
        alt={item.title}
        className="absolute inset-0 w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
      />
      <div className="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent" />
      
      <div className="relative h-full flex flex-col justify-end p-6">
        <div className="mb-2">
          <span className="inline-block px-3 py-1 bg-blue-600 text-white text-xs font-semibold rounded-full mb-1">
            {item.category}
          </span>
          <span className="block text-sm text-white/80">{item.date}</span>
        </div>
        <h3 className="text-white text-lg font-bold leading-tight mb-3">
          {item.title}
        </h3>
        <button className="self-start text-white text-sm font-medium flex items-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
          Baca Selengkapnya
          <svg className="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
          </svg>
        </button>
      </div>
    </div>
  );
}