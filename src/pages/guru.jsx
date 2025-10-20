import { useState, useEffect } from 'react';

export default function Guru() {
  const [gurus, setGurus] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  useEffect(() => {
    const fetchGurus = async () => {
      try {
        const res = await fetch('/src/data/guru.json');
        if (!res.ok) throw new Error('Failed to load data');
        let data = await res.json();

        // Add dummy photo if not exists
        data = data.map(guru => ({
          ...guru,
          foto: guru.foto || `https://i.pravatar.cc/400?u=${guru.id || guru.nama}`,
        }));

        setGurus(data);
      } catch (err) {
        setError(err.message);
      } finally {
        setLoading(false);
      }
    };

    fetchGurus();
  }, []);

  if (loading) return <div className="p-6 text-center">Loading...</div>;
  if (error) return <div className="p-6 text-center text-red-500">Error: {error}</div>;

  return (
    <div className="relative w-full h-screen bg-gradient-to-b from-blue-100 to-white dark:from-gray-800 dark:to-gray-900">
      <div className="h-full overflow-y-auto">
        <div className="px-8 py-6 mx-auto mt-16">
          <h1 className="text-3xl font-bold mb-4 text-black dark:text-white text-center">
            Daftar Guru
          </h1>

          <div className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            {gurus.map(guru => (
              <div
                key={guru.id || guru.nama}
                className="aspect-square overflow-hidden rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 relative group cursor-pointer"
              >
                {/* Image */}
                <img
                  src={guru.foto}
                  alt={guru.nama}
                  className="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105"
                />

                {/* Overlay on hover */}
                <div className="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-4">
                  <h3 className="font-bold text-white text-lg truncate">
                    {guru.nama}
                  </h3>
                  <p className="text-sm text-gray-200 mt-1">
                    {guru.jabatan}
                  </p>
                </div>
              </div>
            ))}
          </div>
        </div>
      </div>

      {/* Gradient footer fade */}
      <div className="absolute bottom-0 left-0 w-full h-24 pointer-events-none bg-gradient-to-t from-white/80 to-transparent dark:from-gray-900" />
    </div>
  );
}