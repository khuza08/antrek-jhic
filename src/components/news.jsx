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

  const getExcerpt = (item) => {
    if (item.excerpt) return item.excerpt;
    if (item.content) {
      return item.content.length > 150
        ? item.content.substring(0, 150).trimEnd() + "…"
        : item.content;
    }
    return item.summary || "Tidak ada ringkasan.";
  };

  return (
    <section className="w-full py-16 bg-gray-900">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 bg-white rounded-2xl">
        <div className="text-center mb-2">
          <h2
            className="text-6xl font-bold text-gray-900 mb-4 pt-6"
            style={{ fontFamily: "'Times New Roman', serif", fontWeight: 700 }}
          >
            antrek
            <span
              className="italic text-blue-500"
              style={{ fontFamily: "'Times New Roman', serif", fontWeight: 400 }}
            >
              news
            </span>
          </h2>
          <div className="border-t border-gray-300 my-4"></div>
        </div>

        {/* left 4, right scrollable */}
        <div className="grid grid-cols-1 lg:grid-cols-3 gap-8">
          {/* Left 2x2 */}
          <div className="lg:col-span-2">
            <h3
              className="font-bold text-lg text-gray-900 mb-6"
              style={{ fontFamily: "'Times New Roman', serif" }}
            >
              Latest News
            </h3>
            <div className="grid grid-cols-1 sm:grid-cols-2 gap-6">
              {news.length >= 4 ? (
                news.slice(0, 4).map((item, i) => (
                  <div key={i} className="border-b border-gray-200 pb-6 last:border-b-0">
                    <div className="mb-4">
                      <img
                        src={item.image}
                        alt={item.title}
                        className="w-full h-48 object-cover rounded-md"
                      />
                    </div>
                    <h3
                      className="text-xl font-bold text-gray-900 mb-2 leading-tight"
                      style={{ fontFamily: "'Times New Roman', serif", fontWeight: 700 }}
                    >
                      {item.title}
                    </h3>
                    <p
                      className="text-gray-700 mb-3 text-sm"
                      style={{ fontFamily: "'Times New Roman', serif" }}
                    >
                      {getExcerpt(item)}
                    </p>
                    <p className="text-xs text-gray-500">{item.readTime} MIN READ</p>
                  </div>
                ))
              ) : (
                <p className="text-center text-gray-500 col-span-2">Memuat berita...</p>
              )}
            </div>
          </div>

          {/* Kolom Kanan: Scrollable List */}
          <div>
            <h3
              className="font-bold text-lg text-gray-900 mb-4"
              style={{ fontFamily: "'Times New Roman', serif" }}
            >
              Recent news
            </h3>
            <div
              className="space-y-6 max-h-[500px] overflow-y-auto pr-2"
              style={{ scrollbarWidth: "thin", scrollbarColor: "#cbd5e1 #fff" }}
            >
              {news.length > 4 ? (
                news.slice(4).map((item, i) => (
                  <div
                    key={i}
                    className={`flex items-start space-x-4 pb-4 ${
                      i < news.length - 5 ? "border-b border-gray-200" : ""
                    }`}
                  >
                    <div className="flex-1">
                      <h4
                        className="text-lg font-bold text-gray-900 mb-1 leading-tight"
                        style={{ fontFamily: "'Times New Roman', serif", fontWeight: 700 }}
                      >
                        {item.title}
                      </h4>
                      <p
                        className="text-gray-700 text-sm mb-2"
                        style={{ fontFamily: "'Times New Roman', serif" }}
                      >
                        {getExcerpt(item)}
                      </p>
                      <p className="text-xs text-gray-500">{item.readTime} MIN READ</p>
                    </div>
                    <img
                      src={item.image}
                      alt={item.title}
                      className="w-24 h-24 object-cover rounded-md flex-shrink-0"
                    />
                  </div>
                ))
              ) : (
                <p className="text-center text-gray-500">Tidak ada berita lain.</p>
              )}
            </div>
          </div>
        </div>
      </div>
    </section>
  );
}