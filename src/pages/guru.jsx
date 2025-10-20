import { useState, useEffect, useMemo } from "react";

export default function Guru() {
  const [gurus, setGurus] = useState([]);
  const [majors, setMajors] = useState([]);
  const [selectedMajor, setSelectedMajor] = useState("all");
  const [searchQuery, setSearchQuery] = useState("");
  const [viewMode, setViewMode] = useState("grid"); // 'grid' or 'list'
  const [isFilterOpen, setIsFilterOpen] = useState(false);
  const [tempMajor, setTempMajor] = useState("all"); // for modal
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  useEffect(() => {
    const fetchGurus = async () => {
      try {
        const res = await fetch("http://localhost:8000/api/teachers");
        if (!res.ok) throw new Error("Failed to load data");
        const rawData = await res.json();

        const processed = rawData.map((teacher) => ({
          id: teacher.id,
          nama: teacher.name,
          jabatan: teacher.role?.role_name || "Tidak Diketahui",
          foto: teacher.image || `https://i.pravatar.cc/400?u=${teacher.id}`,
          description: teacher.description,
          rate: teacher.rate,
        }));

        setGurus(processed);

        const uniqueMajors = [
          ...new Set(processed.map((g) => g.jabatan).filter(Boolean)),
        ];
        setMajors(uniqueMajors);
      } catch (err) {
        setError(err.message);
      } finally {
        setLoading(false);
      }
    };

    fetchGurus();
  }, []);

  const filteredGurus = useMemo(() => {
    return gurus.filter((guru) => {
      const matchesMajor =
        selectedMajor === "all" || guru.jabatan === selectedMajor;
      const matchesSearch = guru.nama
        .toLowerCase()
        .includes(searchQuery.toLowerCase());
      return matchesMajor && matchesSearch;
    });
  }, [gurus, selectedMajor, searchQuery]);

  const applyFilters = () => {
    setSelectedMajor(tempMajor);
    setIsFilterOpen(false);
  };

  const resetFilters = () => {
    setTempMajor("all");
    setSelectedMajor("all");
    setSearchQuery("");
    setIsFilterOpen(false);
  };

  if (loading) return <div className="p-6 text-center">Loading...</div>;
  if (error)
    return <div className="p-6 text-center text-red-500">Error: {error}</div>;

  const totalResults = filteredGurus.length;
  const showing =
    totalResults > 0
      ? `Showing 1-${Math.min(12, totalResults)} of ${totalResults} results`
      : "Showing 0 of 0 results";

  return (
    <div className="py-12 px-18 relative w-full bg-gradient-to-b from-blue-100 to-white dark:from-gray-800 dark:to-gray-900 min-h-screen pb-8">
      <div className="overflow-y-auto pt-16">
        {/* Header Bar */}
        <div className=" px-4 sm:px-8 py-3 mb-6 flex flex-col sm:flex-row items-center justify-between gap-4 rounded-xl shadow-sm">
          <div className="flex items-center space-x-2">
            <button
              onClick={() => setViewMode("grid")}
              className={`font-medium px-4 py-2 rounded-full flex items-center gap-1 transition-colors ${
                viewMode === "grid"
                  ? "bg-white text-indigo-600 shadow-sm"
                  : "bg-transparent text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700"
              }`}
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                className="h-5 w-5"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
              >
                <path
                  strokeLinecap="round"
                  strokeLinejoin="round"
                  strokeWidth={2}
                  d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"
                />
              </svg>
              Grid
            </button>
            <button
              onClick={() => setViewMode("list")}
              className={`font-medium px-4 py-2 rounded-full flex items-center gap-1 transition-colors ${
                viewMode === "list"
                  ? "bg-white text-indigo-600 shadow-sm"
                  : "bg-transparent text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700"
              }`}
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                className="h-5 w-5"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
              >
                <path
                  strokeLinecap="round"
                  strokeLinejoin="round"
                  strokeWidth={2}
                  d="M4 6h16M4 12h16M4 18h16"
                />
              </svg>
              List
            </button>
          </div>

          <p className="text-sm font-medium text-gray-700 dark:text-gray-300 whitespace-nowrap">
            {showing}
          </p>

          <div className="flex items-center space-x-3 w-full sm:w-auto">
            <div className="relative flex-grow max-w-md">
              <input
                type="text"
                value={searchQuery}
                onChange={(e) => setSearchQuery(e.target.value)}
                placeholder="Search Your Daftar Guru..."
                className="w-full pl-4 pr-10 py-2 rounded-full border border-white/30 bg-white/50 backdrop-blur-sm text-gray-800 placeholder-gray-500 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"
              />
              <svg
                xmlns="http://www.w3.org/2000/svg"
                className="absolute right-3 top-1/2 -translate-y-1/2 h-5 w-5 text-gray-500"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
              >
                <path
                  strokeLinecap="round"
                  strokeLinejoin="round"
                  strokeWidth={2}
                  d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                />
              </svg>
            </div>

            <button
              onClick={() => {
                setTempMajor(selectedMajor);
                setIsFilterOpen(true);
              }}
              className="bg-white text-gray-800 font-medium px-4 py-2 rounded-full shadow-sm flex items-center gap-1 hover:bg-gray-100 transition-colors"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                className="h-5 w-5"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
              >
                <path
                  strokeLinecap="round"
                  strokeLinejoin="round"
                  strokeWidth={2}
                  d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.586.894l-6 6a1 1 0 01-1.414 0l-6-6A1 1 0 013 6.586V4z"
                />
                <path
                  strokeLinecap="round"
                  strokeLinejoin="round"
                  strokeWidth={2}
                  d="M15 19l-6-6m6 6l-6 6m6-6v6"
                />
              </svg>
              Filter
            </button>
          </div>
        </div>

        {/* Filter Modal */}
        {isFilterOpen && (
          <div className="fixed inset-0 bg-black/50 flex items-center justify-center z-50 p-4">
            <div className="bg-white dark:bg-gray-800 rounded-xl shadow-xl w-full max-w-md p-6">
              <h3 className="text-lg font-bold mb-4 text-gray-900 dark:text-white">
                Filter by Major
              </h3>

              <div className="space-y-3 mb-6">
                <label className="flex items-center">
                  <input
                    type="radio"
                    name="major"
                    checked={tempMajor === "all"}
                    onChange={() => setTempMajor("all")}
                    className="mr-2"
                  />
                  <span className="text-gray-700 dark:text-gray-300">
                    All Majors
                  </span>
                </label>
                {majors.map((major) => (
                  <label key={major} className="flex items-center">
                    <input
                      type="radio"
                      name="major"
                      checked={tempMajor === major}
                      onChange={() => setTempMajor(major)}
                      className="mr-2"
                    />
                    <span className="text-gray-700 dark:text-gray-300">
                      {major}
                    </span>
                  </label>
                ))}
              </div>

              <div className="flex justify-end space-x-3">
                <button
                  onClick={resetFilters}
                  className="px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg"
                >
                  Reset
                </button>
                <button
                  onClick={applyFilters}
                  className="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700"
                >
                  Apply
                </button>
              </div>

              <button
                onClick={() => setIsFilterOpen(false)}
                className="absolute top-4 right-4 text-gray-500 hover:text-gray-700 dark:text-gray-400"
              >
                ✕
              </button>
            </div>
          </div>
        )}

        {/* Results */}
        <div className="px-4 sm:px-8 mx-auto max-w-7xl">
          {filteredGurus.length === 0 ? (
            <p className="text-center text-gray-600 dark:text-gray-400 mt-8">
              Tidak ada guru yang ditemukan.
            </p>
          ) : viewMode === "grid" ? (
            <div className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
              {filteredGurus.map((guru) => (
                <div
                  key={guru.id}
                  className="aspect-square overflow-hidden rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 relative group cursor-pointer"
                >
                  <img
                    src={guru.foto}
                    alt={guru.nama}
                    className="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105"
                  />
                  <div className="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-4">
                    <h3 className="font-bold text-white text-lg truncate">
                      {guru.nama}
                    </h3>
                    <p className="text-sm text-gray-200 mt-1">{guru.jabatan}</p>
                  </div>
                </div>
              ))}
            </div>
          ) : (
            // List View
            <div className="space-y-4">
              {filteredGurus.map((guru) => (
                <div
                  key={guru.id}
                  className="flex flex-col sm:flex-row items-center p-4 bg-white dark:bg-gray-800 rounded-xl shadow-sm hover:shadow-md transition-shadow"
                >
                  <img
                    src={guru.foto}
                    alt={guru.nama}
                    className="w-24 h-24 object-cover rounded-lg mb-4 sm:mb-0 sm:mr-6"
                  />
                  <div className="text-center sm:text-left">
                    <h3 className="text-xl font-bold text-gray-900 dark:text-white">
                      {guru.nama}
                    </h3>
                    <p className="text-gray-600 dark:text-gray-300 mt-1">
                      {guru.jabatan}
                    </p>
                  </div>
                </div>
              ))}
            </div>
          )}
        </div>
      </div>

      <div className="absolute bottom-0 left-0 w-full h-24 pointer-events-none bg-gradient-to-t from-white/80 to-transparent dark:from-gray-900" />
    </div>
  );
}
