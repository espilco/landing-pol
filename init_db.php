<?php
require 'db.php';

$pdo = get_db();

// Crear tabla si no existe
$pdo->exec("
CREATE TABLE IF NOT EXISTS content (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    section TEXT NOT NULL,
    key TEXT NOT NULL,
    value TEXT,
    UNIQUE(section, key)
);
");

// Sembrar contenido inicial basado en el HTML
$content = [
    // Header
    ['header', 'logo_alt', 'Agile fun!'],
    ['header', 'nav_why', 'Por qué'],
    ['header', 'nav_program', 'Temario'],
    ['header', 'nav_instructor', 'Tu Instructora'],
    ['header', 'nav_whom', 'Para quién'],
    ['header', 'cta_text', 'Inscribirme'],

    // Top banner
    ['banner', 'text', 'Próximo inicio: 15 de febrero, 2026'],
    ['banner', 'button_text', '¡Quiero mi cupo!'],

    // Hero
    ['hero', 'badge', 'Masterclass Online'],
    ['hero', 'title', 'Strategic Delivery Thinking Masterclass'],
    ['hero', 'subtitle', 'Porque <span class="text-primary italic font-semibold">REAL</span> Agile es FUN! 🚀'],
    ['hero', 'cta1_text', 'Asegurar mi lugar'],
    ['hero', 'cta1_url', '#pricing'],
    ['hero', 'video_url', 'https://www.youtube.com/embed/vimtwE7pUA4'],
    ['hero', 'video_label', 'DELIVERY MANAGEMENT'],
    ['hero', 'quote', '"Para líderes de delivery que quieren dejar de apagar incendios"'],

    // Section after hero
    ['strategy', 'title', 'La entrega<br> de valor es un <span class="text-black font-bold text-4xl md:text-7xl">SISTEMA ESTRATÉGICO</span> en movimiento'],
    ['strategy', 'text', 'La entrega de valor no es un acto aislado. Muchas organizaciones se quedan atrapadas en la ejecución sin entender la estrategia que sostiene el delivery moderno.'],
    ['strategy', 'quote', 'Este curso te llevará a dominar la entrega desde una mirada estratégica y sistémica: aprenderás a observar los flujos, gestionar dependencias, elevar la calidad y tomar decisiones basadas en los 6 pilares de la Delivery Coaching Federation. Porque el delivery no es solo cumplir un rol, es generar impacto desde la acción.'],
    ['strategy', 'icon1', 'insights'],
    ['strategy', 'icon1_label', 'Strategy'],
    ['strategy', 'icon2', 'rocket_launch'],
    ['strategy', 'icon2_label', 'Delivery'],

    // Why section
    ['why', 'title', '¿Por qué llevar este curso?'],
    ['why', 'subtitle', 'Desarrolla una visión estratégica del delivery y eleva tu impacto en entornos reales y complejos.'],
    ['why', 'feature1_icon', '🚀'],
    ['why', 'feature1_title', 'Visión estratégica del delivery'],
    ['why', 'feature1_text', 'Desarrolla una mirada integral del delivery con impacto real, más allá de roles, marcos y etiquetas.'],
    ['why', 'feature2_icon', '💡'],
    ['why', 'feature2_title', 'Estrategia conectada a la ejecución'],
    ['why', 'feature2_text', 'Aprende a alinear objetivos estratégicos con la operación diaria de forma coherente.'],
    ['why', 'feature3_icon', '📈'],
    ['why', 'feature3_title', 'Delivery en entornos complejos'],
    ['why', 'feature3_text', 'Incorpora herramientas para gestionar el delivery y elevar la entrega de valor al siguiente nivel.'],

    // Program section
    ['program', 'title', 'Temario Detallado'],
    ['program', 'module1_title', 'The 6 Pillars of Strategic Delivery'],
    ['program', 'module1_content', '<h3 class="text-lg mb-4 text-black">En este módulo aprenderás a:</h3><ul class="space-y-3"><li class="flex gap-2 items-start"><span class="text-primary font-bold">▸</span> Reconocer los 6 pilares del delivery moderno.</li><li class="flex gap-2 items-start"><span class="text-primary font-bold">▸</span> Comprender cómo aplicarlos según el contexto de tu organización.</li><li class="flex gap-2 items-start"><span class="text-primary font-bold">▸</span> Ampliar la mirada del delivery más allá de roles, marcos y etiquetas.</li></ul>'],
    ['program', 'module2_title', 'Value Stream Mapping (VSM)'],
    ['program', 'module2_content', '<h3 class="text-lg mb-4 text-black">En este módulo aprenderás a:</h3><ul class="space-y-3"><li class="flex gap-2 items-start"><span class="text-primary font-bold">▸</span> Observar y mapear flujos de valor de extremo a extremo.</li><li class="flex gap-2 items-start"><span class="text-primary font-bold">▸</span> Identificar cuellos de botella y oportunidades de mejora.</li><li class="flex gap-2 items-start"><span class="text-primary font-bold">▸</span> Analizar el impacto real del trabajo en el negocio y el cliente final.</li></ul>'],
    ['program', 'module3_title', 'Dependency Management & Risk'],
    ['program', 'module3_content', '<h3 class="text-lg mb-4 text-black">En este módulo aprenderás a:</h3><ul class="space-y-3"><li class="flex gap-2 items-start"><span class="text-primary font-bold">▸</span> Gestionar dependencias y riesgos con una visión estratégica.</li><li class="flex gap-2 items-start"><span class="text-primary font-bold">▸</span> Reducir la reactividad y anticiparte a problemas sistémicos.</li><li class="flex gap-2 items-start"><span class="text-primary font-bold">▸</span> Tomar decisiones informadas en entornos complejos y cambiantes.</li></ul>'],
    ['program', 'outcomes', '<h3 class="text-xl font-bold mb-4 text-black">Al finalizar el curso podrás:</h3><ul class="space-y-3 text-slate-600"><li class="flex gap-2 items-start"><span class="text-primary font-bold">▸</span> Elevar los estándares de calidad y consistencia en la entrega.</li><li class="flex gap-2 items-start"><span class="text-primary font-bold">▸</span> Acelerar la capacidad de delivery de los equipos.</li><li class="flex gap-2 items-start"><span class="text-primary font-bold">▸</span> Tomar decisiones estratégicas que generen impacto real y sostenible.</li></ul>'],

    // Info cards
    ['info', 'duration_title', 'Duración'],
    ['info', 'duration_text', '4 semanas / 16 horas de instrucción directa.'],
    ['info', 'format_title', 'Formato'],
    ['info', 'format_text', 'Sesiones en vivo vía Zoom (100% interactivas).'],
    ['info', 'recordings_title', 'Grabaciones'],
    ['info', 'recordings_text', 'Acceso de por vida a las grabaciones del curso.'],
    ['info', 'certification_title', 'Certificación'],
    ['info', 'certification_text', 'Certificado de aprobación por Agile Fun!'],

    // Instructor
    ['instructor', 'title', 'Tu Instructora'],
    ['instructor', 'image', 'images/profesora.jpeg'],
    ['instructor', 'bio', '<p><span class="font-bold text-black">Acompaño a personas y equipos a trabajar mejor juntos</span>, conectando propósito, aprendizaje y resultados de negocio.</p><p>Soy <span class="font-bold text-black">Agile Team Coach y Scrum Master Senior</span>, Contadora Pública Colegiada, con más de 15 años de experiencia en el sector financiero. He acompañado equipos en procesos de transformación ágil, siempre desde una mirada práctica, empática y orientada al impacto.</p><p>Creo en la agilidad como una forma de pensar y evolucionar, poniendo a <span class="font-bold text-black">las personas en el centro y el valor como norte</span>.</p>'],
    ['instructor', 'linkedin_url', '#'],
    ['instructor', 'badge1', 'Senior Expert'],
    ['instructor', 'badge2', '15+ Años Exp.'],

    // Whom
    ['whom', 'title', '¿Para quién es adecuado este curso?'],
    ['whom', 'list', '<li>Delivery Managers</li><li>Scrum Masters</li><li>Product Owners</li><li>Agile Coaches</li><li>Project Managers</li><li>Release Train Engineers</li><li>Engineering Managers</li><li>Business Analysts</li>'],
    ['whom', 'ideal_title', 'Ideal si buscas...'],
    ['whom', 'ideal_text', 'Ampliar tu impacto en la organización, conectando la estrategia con la ejecución diaria y liderando la entrega de valor desde una visión integral, no desde la urgencia.'],
    ['whom', 'tag1', 'Impacto más allá del rol'],
    ['whom', 'tag2', 'Estrategia a la operación'],
    ['whom', 'tag3', 'Delivery con visión global'],
    ['whom', 'tag4', 'Entrega de valor'],

    // Pricing
    ['pricing', 'title', 'Inversión'],
    ['pricing', 'price', '$349'],
    ['pricing', 'currency', 'USD'],
    ['pricing', 'features', '<li class="flex items-center gap-3"><span class="material-symbols-outlined text-green-500">check_circle</span> 16 horas de formación en vivo</li><li class="flex items-center gap-3"><span class="material-symbols-outlined text-green-500">check_circle</span> Toolkit de plantillas VSM</li><li class="flex items-center gap-3"><span class="material-symbols-outlined text-green-500">check_circle</span> Comunidad privada en Discord</li><li class="flex items-center gap-3"><span class="material-symbols-outlined text-green-500">check_circle</span> Certificado oficial</li>'],
    ['pricing', 'button_text', 'Inscribirme ahora'],
    ['pricing', 'guarantee', 'Garantía de satisfacción de 7 días o devolución completa.'],

    // Testimonials
    ['testimonials', 'title', 'Testimonios'],
    ['testimonials', 'test1_text', '"Instructor posee una gran capacidad para la enseñanza. Participé en las masterclass de diversos modelos de trabajo, el desarrollo de soluciones procesos de entrega. No solo dominó el tema con casos de éxito, sino que también tiene un ambiente de aprendizaje dinámico y colaborativo."'],
    ['testimonials', 'test1_name', 'Mónica Cáceres'],
    ['testimonials', 'test1_role', 'Project Manager | ICP-APM'],
    ['testimonials', 'test1_image', 'https://lh3.googleusercontent.com/aida-public/AB6AXuBgkAgNxeN-0f1JWEvL3Y63_o3kGhCQA0VoPguKAGKBqNeOSW88f9anq7CAc1p-vkvO3QClebJxnd49VUig8b2VvTPkGoPmwGbj99tR-q7vbgMVtRRQu4FJ9KGmj9j7BGGxhN0hs3M2vBJ_eunQcyYZAQckAVybO-ft05JB4_MrC7zCuZbvX4KM_EGpK2gYH0Etwl3xG_TPdZd4xP2SXY2x-hWQbekcHKSugXI8tRONnb6lOFEZ0rNFz0k6zv-FGMLvaG-KYOKt2k'],
    ['testimonials', 'test2_text', '"Quiero recomendar de manera especial a Instructor por el excelente dictado del curso Agile Project and Delivery Management. Su forma de enseñar, la claridad con la que transmite conceptos complejos y la capacidad de conectar la teoría con la práctica hicieron que el aprendizaje fuera realmente valioso."'],
    ['testimonials', 'test2_name', 'Cristian Alvarado'],
    ['testimonials', 'test2_role', 'Agile Coach | Scrum Master'],
    ['testimonials', 'test2_image', 'https://lh3.googleusercontent.com/aida-public/AB6AXuAnd7wAAiGUwTtdETiNMSg5Zg8BJIcw86Kk5WbynlQy7ksxLbpGjs8NW2aJqc1yPqwdbiO40fU3yKgrnEYRM7uryq8dwOpP38Oyn_uLshF-sG61HuOmnGt1Ul9l-FuTUJUsrGlzyA1q6ob7vehQnJ7KvcyhZ2jCgEDKpXksNC3gIfopo3PekQbgFF4tth1ATkJw0BRprHe71ugMI92xAHRxxbXFOxFkEbsY7_7mXQ57Bn6rAg_lgXU7uEom-Mqo4V5tSl-1PcfPBM'],
    ['testimonials', 'test3_text', '"Tuve la oportunidad de participar en el curso de Delivery Management dictado por Instructor, y quiero expresar mi sincero agradecimiento por el aprendizaje de tan alto nivel. Instructor demuestra un profundo conocimiento en el tema, el cual transmite con mucha claridad y paciencia."'],
    ['testimonials', 'test3_name', 'Steiner Martin'],
    ['testimonials', 'test3_role', 'Agile Lead | Digital Transformation'],
    ['testimonials', 'test3_image', 'https://lh3.googleusercontent.com/aida-public/AB6AXuCeHhL8bemxEq8hJk3-1Mau0YfpbCX_8Yn8upeh9Yms4EakCL14yOAou1CNuih1H_RmpvlmcB7UyWgPfCN7pxjY-ibWOz3v9QWXYz8-xLBGKl_s2B1BtzAttlQ542xp0HiS75c2gaLDBgEmW5LuEkRj0zsCW4cC_9vMDnfdyR2xt3mNeyZw9lg4uJen_pBJDHnRkqrKDqjVyfVzArU0S35jfIU5WgfQKa9P-Rxp1uWVoWfpMo7tHjOplRA_aTtcLlCDDCl_fusq5Xk'],

    // FAQ
    ['faq', 'title', 'Preguntas Frecuentes'],
    ['faq', 'q1', '¿Necesito conocimientos previos de agilidad?'],
    ['faq', 'a1', 'Es recomendable tener experiencia básica trabajando en equipos ágiles o gestión de proyectos, ya que el curso se enfoca en niveles estratégicos y avanzados.'],
    ['faq', 'q2', '¿Entregan certificado al finalizar?'],
    ['faq', 'a2', 'Sí, al completar satisfactoriamente el curso y las actividades prácticas, recibirás un certificado digital avalado por Agile Fun!'],
    ['faq', 'q3', '¿Qué pasa si me pierdo una sesión en vivo?'],
    ['faq', 'a3', 'Todas las sesiones son grabadas y subidas a nuestra plataforma de alumnos en menos de 24 horas para que puedas verlas cuando prefieras.'],

    // Contact
    ['contact', 'title', '¿Buscas otra fecha?'],
    ['contact', 'subtitle', 'Súmate a nuestra lista de espera, déjanos saber cuál sería el mes de tu preferencia para enviarte fechas propuestas.'],
    ['contact', 'button_text', 'Sumarme'],

    // Footer
    ['footer', 'logo_alt', 'Agile fun!'],
    ['footer', 'text', 'Empowering professionals to find the joy in delivery through strategic thinking and modern agile practices.'],
    ['footer', 'tagline', 'APRENDER, PRACTICAR Y DISFRUTAR!'],
    ['footer', 'contact_email', 'hello@agilefun.com'],
    ['footer', 'contact_location', 'Remoto / Global'],
    ['footer', 'social_linkedin', '#'],
    ['footer', 'copyright', '© 2026 Strategic Delivery Thinking Professional. Todos los derechos reservados.'],
    ['footer', 'privacy', 'Políticas de Privacidad'],
    ['footer', 'terms', 'Términos de Servicio'],
];

foreach ($content as $item) {
    $stmt = $pdo->prepare("INSERT OR IGNORE INTO content (section, key, value) VALUES (?, ?, ?)");
    $stmt->execute($item);
}

echo "Base de datos inicializada con contenido de ejemplo.\n";
?>