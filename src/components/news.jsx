import { useState, useEffect } from "react";

export default function News() {
  const [news, setNewsData] = useState([]);

  useEffect(() => {
    const fetchNews = async () => {
      try {
        const res = await fetch("https://bealderlake.jh-beon.cloud/api/news");
        console.log("Response status:", res.status);
        if (!res.ok) {
          throw new Error("ERROR Failed to fetch news " + res.status);
        }
        const data = await res.json();
        setNewsData(data || []);
      } catch (err) {
        console.error("Error fetching news:", err);
      }
    };
    fetchNews();
  }, []);

  return (
    <section className="w-full bg-gradient-to-b from-white to-blue-100 dark:from-slate-800 dark:to-slate-900 py-16">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="text-center mb-12">
          <h2
            className="text-3xl font-bold text-gray-800 dark:text-white mb-4"
            data-aos="fade-in"
          >
            Berita{" "}
            <span
              className="italic text-blue-600 dark:text-blue-400"
              style={{ fontFamily: "'Instrument Serif', serif" }}
            >
              Terbaru
            </span>
          </h2>
          <p
            className="text-gray-600 dark:text-slate-300 max-w-2xl mx-auto"
            data-aos="fade-in"
          >
            Ikuti perkembangan terbaru dan cerita inspiratif dari komunitas kami
          </p>
        </div>

        {/* Grid Berita */}
        <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
          {news.length > 0 ? (
            news.map((item, i) => <NewsCard key={i} item={item} />)
          ) : (
            <p className="text-center text-gray-600 dark:text-gray-300">
              Memuat berita...
            </p>
          )}
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
        src={item.image}
        alt={item.title}
        className="absolute inset-0 w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
      />
      <div className="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent" />

      <div className="relative h-full flex flex-col justify-end p-6">
        <div className="mb-2">
          <span className="inline-block px-3 py-1 bg-blue-600 text-white text-xs font-semibold rounded-full mb-1">
            {item.category?.name || "Tanpa Kategori"}
          </span>
          <span className="block text-sm text-white/80">
            {new Date(item.created_at).toLocaleDateString("id-ID", {
              day: "numeric",
              month: "long",
              year: "numeric",
            })}
          </span>
        </div>
        <h3 className="text-white text-lg font-bold leading-tight mb-3">
          {item.title}
        </h3>
        <button className="self-start text-white text-sm font-medium flex items-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
          Baca Selengkapnya
          <svg
            className="w-4 h-4 ml-2"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
          >
            <path
              strokeLinecap="round"
              strokeLinejoin="round"
              strokeWidth="2"
              d="M14 5l7 7m0 0l-7 7m7-7H3"
            ></path>
          </svg>
        </button>
      </div>
    </div>
  );
}
