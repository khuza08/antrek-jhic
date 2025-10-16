import Hero from '../components/hero'
import Prestasi from '../components/cardPrestasi'
import Slogan from '../components/sloganSekolah'
import ToggleTheme from '../components/toggleTheme';
import Kepsek from '../components/kepsek';
import { DivSpacer } from '../components/spacer';
import Jurusan from '../components/jurusan';
import GalleryGrid from '../components/galleryGrid';
import News from '../components/news';
import Alumni from '../components/Alumni';
import Sekitar from '../components/sekitar';
import Faq from '../components/faq'
import Contact from '../components/contactForm'

export default function Home() {
  return (
    <div>
      <Hero />

      <Slogan />
      <DivSpacer />
      <Kepsek />
      <DivSpacer />
      <ToggleTheme />

      <DivSpacer />
      <Prestasi />
            <DivSpacer />

      <Jurusan />
      <GalleryGrid />
      <News />
      <DivSpacer />
      <Alumni />
            <DivSpacer />
      <Sekitar />
      <DivSpacer />
      <Faq />
      <Contact />
    </div>
  );
}