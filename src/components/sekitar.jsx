import { useEffect } from "react";
import SectionTitle from "./sectionTitle";

export default function InstagramSection() {
  useEffect(() => {

    const script = document.createElement("script");
    script.src = "https://www.instagram.com/embed.js";
    script.async = true;
    document.body.appendChild(script);
  }, []);

  const posts = [
    "https://www.instagram.com/p/DLduXRiT1bl/",
    "https://www.instagram.com/p/DLvoTHvT9VI/",
    "https://www.instagram.com/p/DKtPWAxTnsz/",
  ];

  return (
    <section className="py-16 bg-blue-100 dark:bg-slate-900">
      <div className="max-w-6xl mx-auto px-4" data-aos="fade-in">
        <div className='text-center py-8' >
          <SectionTitle>
            Around the <span className='italic text-blue-600 dark:text-blue-400' style={{ fontFamily: "'Instrument Serif', serif" }}>
              School
            </span>
          </SectionTitle>
          <p data-aos="fade-in" className="mt-4 text-gray-700 dark:text-slate-300 max-w-2xl mx-auto">
            Lihat momen-momen terbaik kami di Instagram
          </p>
        </div>
        
        <div className="grid md:grid-cols-3 gap-6">
          {posts.map((url, index) => (
            <div
              key={index}
              className="bg-white dark:bg-slate-800 p-4 rounded-xl shadow-lg"
              dangerouslySetInnerHTML={{
                __html: `
                  <blockquote class="instagram-media" 
                    data-instgrm-permalink="${url}" 
                    data-instgrm-version="14"
                    style="background:transparent; border:0; border-radius:8px; padding:0; margin:0 auto; width:100%;">
                  </blockquote>
                `,
              }}
            />
          ))}
        </div>
        

      </div>
    </section>
  );
}