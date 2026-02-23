<?php
session_start();
require 'db.php';

// Configuración de login simple (cambiar en producción)
$admin_user = 'adminAgile';
$admin_pass = password_hash('LandingAgile26*', PASSWORD_DEFAULT); // Cambiar 'password' por algo seguro

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    if ($_POST['username'] === $admin_user && password_verify($_POST['password'], $admin_pass)) {
        $_SESSION['logged_in'] = true;
    } else {
        $error = 'Credenciales incorrectas';
    }
}

if (!isset($_SESSION['logged_in'])) {
    ?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Login Admin</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="bg-gray-100 flex items-center justify-center min-h-screen">
        <form method="post" class="bg-white p-8 rounded shadow-md">
            <h2 class="text-2xl mb-4">Login Admin</h2>
            <?php if (isset($error)) echo "<p class='text-red-500'>$error</p>"; ?>
            <input type="text" name="username" placeholder="Usuario" class="border p-2 w-full mb-4" required>
            <input type="password" name="password" placeholder="Contraseña" class="border p-2 w-full mb-4" required>
            <button type="submit" name="login" class="bg-blue-500 text-white px-4 py-2 w-full">Entrar</button>
        </form>
    </body>
    </html>
    <?php
    exit;
}

// Manejar guardado de contenido
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save'])) {
    foreach ($_POST as $key => $value) {
        if ($key !== 'save' && strpos($key, '_') !== false) {
            list($section, $field) = explode('_', $key, 2);
            set_content($section, $field, $value);
        }
    }
    // Manejar uploads
    $upload_dir = __DIR__ . '/uploads/';
    if (!is_dir($upload_dir)) mkdir($upload_dir, 0755, true);
    foreach ($_FILES as $key => $file) {
        if ($file['error'] === UPLOAD_ERR_OK) {
            $filename = basename($file['name']);
            $target = $upload_dir . $filename;
            if (move_uploaded_file($file['tmp_name'], $target)) {
                list($section, $field) = explode('_', $key, 2);
                set_content($section, $field, 'uploads/' . $filename);
            }
        }
    }
    $message = 'Contenido guardado.';
}

// Obtener todo el contenido
$content = [];
foreach (get_all_content() as $row) {
    $content[$row['section']][$row['key']] = $row['value'];
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Administración</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-3xl mb-6">Panel de Administración</h1>
        <?php if (isset($message)) echo "<p class='text-green-500 mb-4'>$message</p>"; ?>
        <form method="post" enctype="multipart/form-data" class="space-y-8">
            <!-- Header -->
            <div class="bg-white p-6 rounded shadow">
                <h2 class="text-xl mb-4">Header</h2>
                <input type="text" name="header_logo_alt" value="<?php echo htmlspecialchars($content['header']['logo_alt'] ?? ''); ?>" placeholder="Logo Alt" class="border p-2 w-full mb-2">
                <input type="text" name="header_nav_why" value="<?php echo htmlspecialchars($content['header']['nav_why'] ?? ''); ?>" placeholder="Nav Why" class="border p-2 w-full mb-2">
                <input type="text" name="header_nav_program" value="<?php echo htmlspecialchars($content['header']['nav_program'] ?? ''); ?>" placeholder="Nav Program" class="border p-2 w-full mb-2">
                <input type="text" name="header_nav_instructor" value="<?php echo htmlspecialchars($content['header']['nav_instructor'] ?? ''); ?>" placeholder="Nav Instructor" class="border p-2 w-full mb-2">
                <input type="text" name="header_nav_whom" value="<?php echo htmlspecialchars($content['header']['nav_whom'] ?? ''); ?>" placeholder="Nav Whom" class="border p-2 w-full mb-2">
                <input type="text" name="header_cta_text" value="<?php echo htmlspecialchars($content['header']['cta_text'] ?? ''); ?>" placeholder="CTA Text" class="border p-2 w-full">
            </div>

            <!-- Banner -->
            <div class="bg-white p-6 rounded shadow">
                <h2 class="text-xl mb-4">Banner</h2>
                <input type="text" name="banner_text" value="<?php echo htmlspecialchars($content['banner']['text'] ?? ''); ?>" placeholder="Banner Text" class="border p-2 w-full mb-2">
                <input type="text" name="banner_button_text" value="<?php echo htmlspecialchars($content['banner']['button_text'] ?? ''); ?>" placeholder="Button Text" class="border p-2 w-full">
            </div>

            <!-- Hero -->
            <div class="bg-white p-6 rounded shadow">
                <h2 class="text-xl mb-4">Hero</h2>
                <input type="text" name="hero_badge" value="<?php echo htmlspecialchars($content['hero']['badge'] ?? ''); ?>" placeholder="Badge" class="border p-2 w-full mb-2">
                <input type="text" name="hero_title" value="<?php echo htmlspecialchars($content['hero']['title'] ?? ''); ?>" placeholder="Title" class="border p-2 w-full mb-2">
                <textarea name="hero_subtitle" placeholder="Subtitle" class="border p-2 w-full mb-2" rows="3"><?php echo htmlspecialchars($content['hero']['subtitle'] ?? ''); ?></textarea>
                <input type="text" name="hero_cta1_text" value="<?php echo htmlspecialchars($content['hero']['cta1_text'] ?? ''); ?>" placeholder="CTA Text" class="border p-2 w-full mb-2">
                <input type="url" name="hero_video_url" value="<?php echo htmlspecialchars($content['hero']['video_url'] ?? ''); ?>" placeholder="Video URL" class="border p-2 w-full mb-2">
                <input type="text" name="hero_video_label" value="<?php echo htmlspecialchars($content['hero']['video_label'] ?? ''); ?>" placeholder="Video Label" class="border p-2 w-full mb-2">
                <input type="text" name="hero_quote" value="<?php echo htmlspecialchars($content['hero']['quote'] ?? ''); ?>" placeholder="Quote" class="border p-2 w-full">
            </div>

            <!-- Strategy -->
            <div class="bg-white p-6 rounded shadow">
                <h2 class="text-xl mb-4">Strategy Section</h2>
                <textarea name="strategy_title" placeholder="Title" class="border p-2 w-full mb-2" rows="2"><?php echo htmlspecialchars($content['strategy']['title'] ?? ''); ?></textarea>
                <textarea name="strategy_text" placeholder="Text" class="border p-2 w-full mb-2" rows="3"><?php echo htmlspecialchars($content['strategy']['text'] ?? ''); ?></textarea>
                <textarea name="strategy_quote" placeholder="Quote" class="border p-2 w-full mb-2" rows="3"><?php echo htmlspecialchars($content['strategy']['quote'] ?? ''); ?></textarea>
                <input type="text" name="strategy_icon1" value="<?php echo htmlspecialchars($content['strategy']['icon1'] ?? ''); ?>" placeholder="Icon 1" class="border p-2 w-full mb-2">
                <input type="text" name="strategy_icon1_label" value="<?php echo htmlspecialchars($content['strategy']['icon1_label'] ?? ''); ?>" placeholder="Icon 1 Label" class="border p-2 w-full mb-2">
                <input type="text" name="strategy_icon2" value="<?php echo htmlspecialchars($content['strategy']['icon2'] ?? ''); ?>" placeholder="Icon 2" class="border p-2 w-full mb-2">
                <input type="text" name="strategy_icon2_label" value="<?php echo htmlspecialchars($content['strategy']['icon2_label'] ?? ''); ?>" placeholder="Icon 2 Label" class="border p-2 w-full">
            </div>

            <!-- Why -->
            <div class="bg-white p-6 rounded shadow">
                <h2 class="text-xl mb-4">Why Section</h2>
                <input type="text" name="why_title" value="<?php echo htmlspecialchars($content['why']['title'] ?? ''); ?>" placeholder="Title" class="border p-2 w-full mb-2">
                <textarea name="why_subtitle" placeholder="Subtitle" class="border p-2 w-full mb-2" rows="2"><?php echo htmlspecialchars($content['why']['subtitle'] ?? ''); ?></textarea>
                <input type="text" name="why_feature1_icon" value="<?php echo htmlspecialchars($content['why']['feature1_icon'] ?? ''); ?>" placeholder="Feature 1 Icon" class="border p-2 w-full mb-2">
                <input type="text" name="why_feature1_title" value="<?php echo htmlspecialchars($content['why']['feature1_title'] ?? ''); ?>" placeholder="Feature 1 Title" class="border p-2 w-full mb-2">
                <textarea name="why_feature1_text" placeholder="Feature 1 Text" class="border p-2 w-full mb-2" rows="2"><?php echo htmlspecialchars($content['why']['feature1_text'] ?? ''); ?></textarea>
                <input type="text" name="why_feature2_icon" value="<?php echo htmlspecialchars($content['why']['feature2_icon'] ?? ''); ?>" placeholder="Feature 2 Icon" class="border p-2 w-full mb-2">
                <input type="text" name="why_feature2_title" value="<?php echo htmlspecialchars($content['why']['feature2_title'] ?? ''); ?>" placeholder="Feature 2 Title" class="border p-2 w-full mb-2">
                <textarea name="why_feature2_text" placeholder="Feature 2 Text" class="border p-2 w-full mb-2" rows="2"><?php echo htmlspecialchars($content['why']['feature2_text'] ?? ''); ?></textarea>
                <input type="text" name="why_feature3_icon" value="<?php echo htmlspecialchars($content['why']['feature3_icon'] ?? ''); ?>" placeholder="Feature 3 Icon" class="border p-2 w-full mb-2">
                <input type="text" name="why_feature3_title" value="<?php echo htmlspecialchars($content['why']['feature3_title'] ?? ''); ?>" placeholder="Feature 3 Title" class="border p-2 w-full mb-2">
                <textarea name="why_feature3_text" placeholder="Feature 3 Text" class="border p-2 w-full mb-2" rows="2"><?php echo htmlspecialchars($content['why']['feature3_text'] ?? ''); ?></textarea>
            </div>

            <!-- Program -->
            <div class="bg-white p-6 rounded shadow">
                <h2 class="text-xl mb-4">Program Section</h2>
                <input type="text" name="program_title" value="<?php echo htmlspecialchars($content['program']['title'] ?? ''); ?>" placeholder="Title" class="border p-2 w-full mb-2">
                <input type="text" name="program_module1_title" value="<?php echo htmlspecialchars($content['program']['module1_title'] ?? ''); ?>" placeholder="Module 1 Title" class="border p-2 w-full mb-2">
                <textarea name="program_module1_content" placeholder="Module 1 Content" class="border p-2 w-full mb-2" rows="5"><?php echo htmlspecialchars($content['program']['module1_content'] ?? ''); ?></textarea>
                <input type="text" name="program_module2_title" value="<?php echo htmlspecialchars($content['program']['module2_title'] ?? ''); ?>" placeholder="Module 2 Title" class="border p-2 w-full mb-2">
                <textarea name="program_module2_content" placeholder="Module 2 Content" class="border p-2 w-full mb-2" rows="5"><?php echo htmlspecialchars($content['program']['module2_content'] ?? ''); ?></textarea>
                <input type="text" name="program_module3_title" value="<?php echo htmlspecialchars($content['program']['module3_title'] ?? ''); ?>" placeholder="Module 3 Title" class="border p-2 w-full mb-2">
                <textarea name="program_module3_content" placeholder="Module 3 Content" class="border p-2 w-full mb-2" rows="5"><?php echo htmlspecialchars($content['program']['module3_content'] ?? ''); ?></textarea>
                <textarea name="program_outcomes" placeholder="Outcomes" class="border p-2 w-full mb-2" rows="5"><?php echo htmlspecialchars($content['program']['outcomes'] ?? ''); ?></textarea>
            </div>

            <!-- Info -->
            <div class="bg-white p-6 rounded shadow">
                <h2 class="text-xl mb-4">Info Cards</h2>
                <input type="text" name="info_duration_title" value="<?php echo htmlspecialchars($content['info']['duration_title'] ?? ''); ?>" placeholder="Duration Title" class="border p-2 w-full mb-2">
                <textarea name="info_duration_text" placeholder="Duration Text" class="border p-2 w-full mb-2" rows="2"><?php echo htmlspecialchars($content['info']['duration_text'] ?? ''); ?></textarea>
                <input type="text" name="info_format_title" value="<?php echo htmlspecialchars($content['info']['format_title'] ?? ''); ?>" placeholder="Format Title" class="border p-2 w-full mb-2">
                <textarea name="info_format_text" placeholder="Format Text" class="border p-2 w-full mb-2" rows="2"><?php echo htmlspecialchars($content['info']['format_text'] ?? ''); ?></textarea>
                <input type="text" name="info_recordings_title" value="<?php echo htmlspecialchars($content['info']['recordings_title'] ?? ''); ?>" placeholder="Recordings Title" class="border p-2 w-full mb-2">
                <textarea name="info_recordings_text" placeholder="Recordings Text" class="border p-2 w-full mb-2" rows="2"><?php echo htmlspecialchars($content['info']['recordings_text'] ?? ''); ?></textarea>
                <input type="text" name="info_certification_title" value="<?php echo htmlspecialchars($content['info']['certification_title'] ?? ''); ?>" placeholder="Certification Title" class="border p-2 w-full mb-2">
                <textarea name="info_certification_text" placeholder="Certification Text" class="border p-2 w-full mb-2" rows="2"><?php echo htmlspecialchars($content['info']['certification_text'] ?? ''); ?></textarea>
            </div>

            <!-- Instructor -->
            <div class="bg-white p-6 rounded shadow">
                <h2 class="text-xl mb-4">Instructor</h2>
                <input type="text" name="instructor_title" value="<?php echo htmlspecialchars($content['instructor']['title'] ?? ''); ?>" placeholder="Title" class="border p-2 w-full mb-2">
                <input type="file" name="instructor_image" class="border p-2 w-full mb-2">
                <textarea name="instructor_bio" placeholder="Bio" class="border p-2 w-full mb-2" rows="5"><?php echo htmlspecialchars($content['instructor']['bio'] ?? ''); ?></textarea>
                <input type="url" name="instructor_linkedin_url" value="<?php echo htmlspecialchars($content['instructor']['linkedin_url'] ?? ''); ?>" placeholder="LinkedIn URL" class="border p-2 w-full mb-2">
                <input type="text" name="instructor_badge1" value="<?php echo htmlspecialchars($content['instructor']['badge1'] ?? ''); ?>" placeholder="Badge 1" class="border p-2 w-full mb-2">
                <input type="text" name="instructor_badge2" value="<?php echo htmlspecialchars($content['instructor']['badge2'] ?? ''); ?>" placeholder="Badge 2" class="border p-2 w-full">
            </div>

            <!-- Whom -->
            <div class="bg-white p-6 rounded shadow">
                <h2 class="text-xl mb-4">Whom Section</h2>
                <input type="text" name="whom_title" value="<?php echo htmlspecialchars($content['whom']['title'] ?? ''); ?>" placeholder="Title" class="border p-2 w-full mb-2">
                <textarea name="whom_list" placeholder="List (HTML)" class="border p-2 w-full mb-2" rows="5"><?php echo htmlspecialchars($content['whom']['list'] ?? ''); ?></textarea>
                <input type="text" name="whom_ideal_title" value="<?php echo htmlspecialchars($content['whom']['ideal_title'] ?? ''); ?>" placeholder="Ideal Title" class="border p-2 w-full mb-2">
                <textarea name="whom_ideal_text" placeholder="Ideal Text" class="border p-2 w-full mb-2" rows="3"><?php echo htmlspecialchars($content['whom']['ideal_text'] ?? ''); ?></textarea>
                <input type="text" name="whom_tag1" value="<?php echo htmlspecialchars($content['whom']['tag1'] ?? ''); ?>" placeholder="Tag 1" class="border p-2 w-full mb-2">
                <input type="text" name="whom_tag2" value="<?php echo htmlspecialchars($content['whom']['tag2'] ?? ''); ?>" placeholder="Tag 2" class="border p-2 w-full mb-2">
                <input type="text" name="whom_tag3" value="<?php echo htmlspecialchars($content['whom']['tag3'] ?? ''); ?>" placeholder="Tag 3" class="border p-2 w-full mb-2">
                <input type="text" name="whom_tag4" value="<?php echo htmlspecialchars($content['whom']['tag4'] ?? ''); ?>" placeholder="Tag 4" class="border p-2 w-full">
            </div>

            <!-- Pricing -->
            <div class="bg-white p-6 rounded shadow">
                <h2 class="text-xl mb-4">Pricing</h2>
                <input type="text" name="pricing_title" value="<?php echo htmlspecialchars($content['pricing']['title'] ?? ''); ?>" placeholder="Title" class="border p-2 w-full mb-2">
                <input type="text" name="pricing_price" value="<?php echo htmlspecialchars($content['pricing']['price'] ?? ''); ?>" placeholder="Price" class="border p-2 w-full mb-2">
                <input type="text" name="pricing_currency" value="<?php echo htmlspecialchars($content['pricing']['currency'] ?? ''); ?>" placeholder="Currency" class="border p-2 w-full mb-2">
                <textarea name="pricing_features" placeholder="Features (HTML)" class="border p-2 w-full mb-2" rows="5"><?php echo htmlspecialchars($content['pricing']['features'] ?? ''); ?></textarea>
                <input type="text" name="pricing_button_text" value="<?php echo htmlspecialchars($content['pricing']['button_text'] ?? ''); ?>" placeholder="Button Text" class="border p-2 w-full mb-2">
                <input type="text" name="pricing_guarantee" value="<?php echo htmlspecialchars($content['pricing']['guarantee'] ?? ''); ?>" placeholder="Guarantee" class="border p-2 w-full">
            </div>

            <!-- Testimonials -->
            <div class="bg-white p-6 rounded shadow">
                <h2 class="text-xl mb-4">Testimonials</h2>
                <input type="text" name="testimonials_title" value="<?php echo htmlspecialchars($content['testimonials']['title'] ?? ''); ?>" placeholder="Title" class="border p-2 w-full mb-2">
                <textarea name="testimonials_test1_text" placeholder="Test 1 Text" class="border p-2 w-full mb-2" rows="3"><?php echo htmlspecialchars($content['testimonials']['test1_text'] ?? ''); ?></textarea>
                <input type="text" name="testimonials_test1_name" value="<?php echo htmlspecialchars($content['testimonials']['test1_name'] ?? ''); ?>" placeholder="Test 1 Name" class="border p-2 w-full mb-2">
                <input type="text" name="testimonials_test1_role" value="<?php echo htmlspecialchars($content['testimonials']['test1_role'] ?? ''); ?>" placeholder="Test 1 Role" class="border p-2 w-full mb-2">
                <input type="url" name="testimonials_test1_image" value="<?php echo htmlspecialchars($content['testimonials']['test1_image'] ?? ''); ?>" placeholder="Test 1 Image URL" class="border p-2 w-full mb-2">
                <textarea name="testimonials_test2_text" placeholder="Test 2 Text" class="border p-2 w-full mb-2" rows="3"><?php echo htmlspecialchars($content['testimonials']['test2_text'] ?? ''); ?></textarea>
                <input type="text" name="testimonials_test2_name" value="<?php echo htmlspecialchars($content['testimonials']['test2_name'] ?? ''); ?>" placeholder="Test 2 Name" class="border p-2 w-full mb-2">
                <input type="text" name="testimonials_test2_role" value="<?php echo htmlspecialchars($content['testimonials']['test2_role'] ?? ''); ?>" placeholder="Test 2 Role" class="border p-2 w-full mb-2">
                <input type="url" name="testimonials_test2_image" value="<?php echo htmlspecialchars($content['testimonials']['test2_image'] ?? ''); ?>" placeholder="Test 2 Image URL" class="border p-2 w-full mb-2">
                <textarea name="testimonials_test3_text" placeholder="Test 3 Text" class="border p-2 w-full mb-2" rows="3"><?php echo htmlspecialchars($content['testimonials']['test3_text'] ?? ''); ?></textarea>
                <input type="text" name="testimonials_test3_name" value="<?php echo htmlspecialchars($content['testimonials']['test3_name'] ?? ''); ?>" placeholder="Test 3 Name" class="border p-2 w-full mb-2">
                <input type="text" name="testimonials_test3_role" value="<?php echo htmlspecialchars($content['testimonials']['test3_role'] ?? ''); ?>" placeholder="Test 3 Role" class="border p-2 w-full mb-2">
                <input type="url" name="testimonials_test3_image" value="<?php echo htmlspecialchars($content['testimonials']['test3_image'] ?? ''); ?>" placeholder="Test 3 Image URL" class="border p-2 w-full">
            </div>

            <!-- FAQ -->
            <div class="bg-white p-6 rounded shadow">
                <h2 class="text-xl mb-4">FAQ</h2>
                <input type="text" name="faq_title" value="<?php echo htmlspecialchars($content['faq']['title'] ?? ''); ?>" placeholder="Title" class="border p-2 w-full mb-2">
                <input type="text" name="faq_q1" value="<?php echo htmlspecialchars($content['faq']['q1'] ?? ''); ?>" placeholder="Q1" class="border p-2 w-full mb-2">
                <textarea name="faq_a1" placeholder="A1" class="border p-2 w-full mb-2" rows="2"><?php echo htmlspecialchars($content['faq']['a1'] ?? ''); ?></textarea>
                <input type="text" name="faq_q2" value="<?php echo htmlspecialchars($content['faq']['q2'] ?? ''); ?>" placeholder="Q2" class="border p-2 w-full mb-2">
                <textarea name="faq_a2" placeholder="A2" class="border p-2 w-full mb-2" rows="2"><?php echo htmlspecialchars($content['faq']['a2'] ?? ''); ?></textarea>
                <input type="text" name="faq_q3" value="<?php echo htmlspecialchars($content['faq']['q3'] ?? ''); ?>" placeholder="Q3" class="border p-2 w-full mb-2">
                <textarea name="faq_a3" placeholder="A3" class="border p-2 w-full mb-2" rows="2"><?php echo htmlspecialchars($content['faq']['a3'] ?? ''); ?></textarea>
            </div>

            <!-- Contact -->
            <div class="bg-white p-6 rounded shadow">
                <h2 class="text-xl mb-4">Contact</h2>
                <input type="text" name="contact_title" value="<?php echo htmlspecialchars($content['contact']['title'] ?? ''); ?>" placeholder="Title" class="border p-2 w-full mb-2">
                <textarea name="contact_subtitle" placeholder="Subtitle" class="border p-2 w-full mb-2" rows="2"><?php echo htmlspecialchars($content['contact']['subtitle'] ?? ''); ?></textarea>
                <input type="text" name="contact_button_text" value="<?php echo htmlspecialchars($content['contact']['button_text'] ?? ''); ?>" placeholder="Button Text" class="border p-2 w-full">
            </div>

            <!-- Footer -->
            <div class="bg-white p-6 rounded shadow">
                <h2 class="text-xl mb-4">Footer</h2>
                <input type="text" name="footer_logo_alt" value="<?php echo htmlspecialchars($content['footer']['logo_alt'] ?? ''); ?>" placeholder="Logo Alt" class="border p-2 w-full mb-2">
                <textarea name="footer_text" placeholder="Text" class="border p-2 w-full mb-2" rows="2"><?php echo htmlspecialchars($content['footer']['text'] ?? ''); ?></textarea>
                <input type="text" name="footer_tagline" value="<?php echo htmlspecialchars($content['footer']['tagline'] ?? ''); ?>" placeholder="Tagline" class="border p-2 w-full mb-2">
                <input type="email" name="footer_contact_email" value="<?php echo htmlspecialchars($content['footer']['contact_email'] ?? ''); ?>" placeholder="Email" class="border p-2 w-full mb-2">
                <input type="text" name="footer_contact_location" value="<?php echo htmlspecialchars($content['footer']['contact_location'] ?? ''); ?>" placeholder="Location" class="border p-2 w-full mb-2">
                <input type="url" name="footer_social_linkedin" value="<?php echo htmlspecialchars($content['footer']['social_linkedin'] ?? ''); ?>" placeholder="LinkedIn URL" class="border p-2 w-full mb-2">
                <input type="text" name="footer_copyright" value="<?php echo htmlspecialchars($content['footer']['copyright'] ?? ''); ?>" placeholder="Copyright" class="border p-2 w-full mb-2">
                <input type="text" name="footer_privacy" value="<?php echo htmlspecialchars($content['footer']['privacy'] ?? ''); ?>" placeholder="Privacy" class="border p-2 w-full mb-2">
                <input type="text" name="footer_terms" value="<?php echo htmlspecialchars($content['footer']['terms'] ?? ''); ?>" placeholder="Terms" class="border p-2 w-full">
            </div>

            <button type="submit" name="save" class="bg-green-500 text-white px-6 py-3 rounded w-full">Guardar Cambios</button>
        </form>
        <a href="?logout=1" class="block mt-4 text-blue-500">Cerrar Sesión</a>
    </div>
</body>
</html>
<?php
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: admin.php');
    exit;
}
?>