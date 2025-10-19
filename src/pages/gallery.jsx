import { useState, useEffect } from "react";

export default function Gallery() {
  const [images, setImagesData] = useState([]);

  useEffect(() => {
    const fetchImages = async () => {
      try {
        const res = await fetch(
          "https://bealderlake.jh-beon.cloud/api/galleries"
        );
        if (!res.ok)
          throw new Error("ERROR Failed to fetch images " + res.status);

        const data = await res.json();

        const converted = data.map((img) => {
          if (
            typeof img.image === "string" &&
            img.image.startsWith("data:image")
          ) {
            return { ...img, src: img.image };
          }

          if (img.image && typeof img.image === "object") {
            const blob = new Blob([new Uint8Array(img.image.data)], {
              type: "image/jpeg", // bisa ganti sesuai tipe file
            });
            const url = URL.createObjectURL(blob);
            return { ...img, src: url };
          }

          return { ...img, src: "" };
        });

        setImagesData(converted);
      } catch (err) {
        console.error("Error fetching images:", err);
      }
    };
    fetchImages();
  }, []);

  return (
    <div className="relative w-full h-screen bg-gradient-to-b from-blue-100 to-white dark:from-gray-800 dark:to-gray-900">
      <div className="h-full overflow-y-auto">
        <div className="px-8 py-6 mx-auto mt-16">
          <h1 className="text-3xl font-bold mb-4 text-black dark:text-white text-center">
            Gallery
          </h1>

          <div className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 2xl:grid-cols-6 gap-4">
            {images.map((img) => (
              <div
                key={img.id}
                className="aspect-square overflow-hidden rounded-xl shadow-sm hover:shadow-md transition-shadow duration-200 relative group"
              >
                <img
                  src={img.src}
                  alt={img.title || ""}
                  className="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105"
                />

                <div className="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-3">
                  <h3 className="font-semibold text-white text-sm truncate">
                    {img.title}
                  </h3>
                  <div className="flex justify-between text-xs text-gray-200 mt-1">
                    <span>{img.category.name}</span>
                    <span>
                      {new Date(img.created_at).toLocaleDateString("id-ID", {
                        day: "numeric",
                        month: "long",
                        year: "numeric",
                      })}
                    </span>
                  </div>
                </div>
              </div>
            ))}
          </div>
        </div>
      </div>

      <div className="absolute bottom-0 left-0 w-full h-24 pointer-events-none bg-gradient-to-t from-white/80 to-transparent dark:from-gray-900" />
    </div>
  );
}
