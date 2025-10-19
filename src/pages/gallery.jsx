export default function Gallery() {
  const images = Array.from({ length: 12 }, (_, i) => ({
    id: i + 1,
    src: `https://picsum.photos/600/400?image=${i * 10}`,
    alt: `Gallery item ${i + 1}`,
  }));

  return (
    <div className="relative w-full h-screen bg-gradient-to-b from-blue-100 to-white dark:from-gray-800 dark:to-gray-900">

      <div className="h-full overflow-y-auto">
        <div className="px-8 py-6 mx-auto mt-16">
          <h1 className="text-3xl font-bold mb-4 text-black dark:text-white text-center">Gallery</h1>
          <div className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 2xl:grid-cols-6 gap-4">
            {images.map((img) => (
              <div
                key={img.id}
                className="aspect-square overflow-hidden rounded-xl shadow-sm hover:shadow-md transition-shadow duration-200"
              >
                <img
                  src={img.src}
                  alt={img.alt}
                  className="w-full h-full object-cover"
                />
              </div>
            ))}
          </div>
        </div>
      </div>

      <div className="absolute bottom-0 left-0 w-full h-24 pointer-events-none bg-gradient-to-t from-white/80 to-transparent dark:from-gray-900" />
    </div>
  );
}