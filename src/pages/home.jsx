import Hero from '../components/hero'
import Prestasi from '../components/cardPrestasi'
import Kepsek from '../components/kepsek';
import { DivSpacer } from '../components/spacer';
import Jurusan from '../components/jurusan';
import News from '../components/news';
import Alumni from '../components/Alumni';
import Sekitar from '../components/sekitar';
import Faq from '../components/faq'

export default function Home() {
  return (
    <div>
      <Hero />

      <Kepsek />
      <DivSpacer />

      <DivSpacer />
      <Prestasi />
      <DivSpacer />

      <Jurusan />
      <News />
      <DivSpacer />
      <Alumni />
      <DivSpacer />
      <Sekitar />
      <DivSpacer />
      <Faq />
    </div>
  );
}