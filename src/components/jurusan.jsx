import { useEffect, useState } from "react";

const Jurusan = () => {
  const [leftColumn, setLeftColumn] = useState([]);
  const [rightColumn, setRightColumn] = useState([]);

  useEffect(() => {
    const fetchMajors = async () => {
      try {
        const res = await fetch("https://bealderlake.jh-beon.cloud/api/majors");

        if (!res.ok) {
          throw new Error("HTTP Error Status: " + res.status);
        }

        const data = await res.json();

        const leftColumn = data.filter((major) => major.category_id === 21);
        const rightColumn = data.filter((major) => major.category_id === 22);
        setLeftColumn(leftColumn);
        setRightColumn(rightColumn);
      } catch (err) {
        console.error(err);
      }
    };
    fetchMajors();
  }, []);

  return (
    <section className="w-full bg-gradient-to-b from-blue-100 to-white dark:from-slate-900 dark:to-gray-800 py-16 px-4 sm:px-6">
      <div className="max-w-6xl mx-auto">
        <div className="text-center mb-12">
          <h2
            className="text-3xl sm:text-4xl font-bold text-gray-800 dark:text-gray-100 mb-4"
            data-aos="fade-in"
          >
            Program{" "}
            <span
              className="italic text-blue-600 dark:text-blue-400"
              style={{ fontFamily: "'Instrument Serif', serif" }}
              data-aos="fade-in"
            >
              Keahlian
            </span>
          </h2>
          <p
            className="text-gray-600 dark:text-slate-300 max-w-2xl mx-auto"
            data-aos="fade-up"
          >
            Pilih program keahlian yang sesuai dengan minat dan bakat Anda
          </p>
        </div>

        <div className="flex flex-col lg:flex-row gap-8">
          {/* Kolom Kiri */}
          <div className="w-full lg:w-1/2">
            <div className="bg-white dark:bg-slate-800 p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow h-full">
              <h3 className="font-semibold text-xl mb-6 text-gray-800 dark:text-slate-200 border-b border-gray-200 dark:border-slate-700 pb-3 flex items-center">
                <svg
                  className="w-6 h-6 text-blue-500 mr-2"
                  fill="none"
                  stroke="currentColor"
                  viewBox="0 0 24 24"
                >
                  <path
                    strokeLinecap="round"
                    strokeLinejoin="round"
                    strokeWidth="2"
                    d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"
                  ></path>
                </svg>
                Teknik
              </h3>
              <ul className="space-y-4">
                {leftColumn.map((jurusan, index) => (
                  <li key={index} className="group">
                    <div className="flex items-start">
                      <span className="bg-blue-100 dark:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-full w-8 h-8 flex items-center justify-center mr-4 mt-1 font-medium flex-shrink-0">
                        {index + 1}
                      </span>
                      <div>
                        <h4 className="text-lg font-medium text-gray-800 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">
                          {jurusan.name}
                        </h4>
                        <p className="text-gray-600 dark:text-slate-400 text-sm mt-1">
                          {jurusan.description}
                        </p>
                      </div>
                    </div>
                  </li>
                ))}
              </ul>
            </div>
          </div>

          {/* Kolom Kanan */}
          <div className="w-full lg:w-1/2">
            <div className="bg-white dark:bg-slate-800 p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow h-full">
              <h3 className="font-semibold text-xl mb-6 text-gray-800 dark:text-slate-200 border-b border-gray-200 dark:border-slate-700 pb-3 flex items-center">
                <svg
                  className="w-6 h-6 text-blue-500 mr-2"
                  fill="none"
                  stroke="currentColor"
                  viewBox="0 0 24 24"
                >
                  <path
                    strokeLinecap="round"
                    strokeLinejoin="round"
                    strokeWidth="2"
                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"
                  ></path>
                </svg>
                Bisnis
              </h3>
              <ul className="space-y-4">
                {rightColumn.map((jurusan) => (
                  <li key={jurusan.id} className="group">
                    <div className="flex items-start">
                      <span className="bg-blue-100 dark:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-full w-8 h-8 flex items-center justify-center mr-4 mt-1 font-medium flex-shrink-0">
                        {jurusan.id}
                      </span>
                      <div>
                        <h4 className="text-lg font-medium text-gray-800 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">
                          {jurusan.name}
                        </h4>
                        <p className="text-gray-600 dark:text-slate-400 text-sm mt-1">
                          {jurusan.description}
                        </p>
                      </div>
                    </div>
                  </li>
                ))}
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>
  );
};

export default Jurusan;
