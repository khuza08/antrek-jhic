import {
  BrowserRouter as Router,
  Routes,
  Route,
  Navigate,
} from "react-router-dom";

import Layout from "./layouts/layout";
import Home from "./pages/home";
import Tentang from "./pages/tentang";
import Guru from "./pages/guru";
import Prestasi from "./pages/prestasi";
import Gallery from "./pages/gallery";
import Contact from "./pages/contact";
import News from "./pages/news";
import Ppdb from "./pages/ppdb";
import NotFound from "./pages/404";
import Login from "./pages/login";
import Regis from "./pages/register";
import "../src/styles/index.css";

export default function App() {
  return (
    <Router>
      <Layout>
        <Routes>
          <Route path="/" element={<Home />} />
          <Route path="/tentang" element={<Tentang />} />
          <Route path="/guru" element={<Guru />} />
          <Route path="/prestasi" element={<Prestasi />} />
          <Route path="/gallery" element={<Gallery />} />
          <Route path="/contact" element={<Contact />} />
          <Route path="/news" element={<News />} />
          <Route path="/ppdb" element={<Ppdb />} />
          <Route path="*" element={<NotFound />} />
          <Route path="/login" element={<Login />} />
          <Route path="/register" element={<Regis />} />
        </Routes>
      </Layout>
    </Router>
  );
}
