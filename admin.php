<?php
// Incluir la conexión a la base de datos
include 'php/db.php';

// Consulta para obtener todos los envíos
$sql = "SELECT * FROM envios ORDER BY fecha_envio DESC";
$resultado = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Panel de Administración - Envíos del Formulario</title>
  <link rel="icon" type="image/png" sizes="32x32" href="./assets/images/favicon-32x32.png">
  
  <style>
    /* ========================================= */
    /* VARIABLES Y RESET */
    /* ========================================= */
    :root {
      --color-green-200: hsl(148, 38%, 91%);
      --color-green-600: hsl(169, 82%, 27%);
      --color-red: hsl(0, 66%, 54%);
      --color-white: hsl(0, 0%, 100%);
      --color-grey-500: hsl(186, 15%, 59%);
      --color-grey-900: hsl(187, 24%, 22%);
      --font-main: 'Karla', sans-serif;
    }

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: var(--font-main);
      background-color: var(--color-green-200);
      padding: 2rem 1rem;
      min-height: 100vh;
    }

    /* ========================================= */
    /* CONTENEDOR PRINCIPAL */
    /* ========================================= */
    .admin-container {
      max-width: 1200px;
      margin: 0 auto;
      background-color: var(--color-white);
      padding: 2.5rem;
      border-radius: 1rem;
      box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.05);
    }

    /* ========================================= */
    /* ENCABEZADO */
    /* ========================================= */
    .admin-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 2rem;
      flex-wrap: wrap;
      gap: 1rem;
    }

    h1 {
      color: var(--color-grey-900);
      font-size: 2rem;
      font-weight: 700;
    }

    .btn-volver {
      display: inline-block;
      padding: 0.8rem 1.5rem;
      background-color: var(--color-green-600);
      color: var(--color-white);
      text-decoration: none;
      border-radius: 0.5rem;
      font-weight: 700;
      transition: background-color 0.3s;
    }

    .btn-volver:hover {
      background-color: hsl(169, 82%, 20%);
    }

    /* ========================================= */
    /* ESTADÍSTICAS */
    /* ========================================= */
    .stats {
      background-color: var(--color-green-200);
      padding: 1rem 1.5rem;
      border-radius: 0.5rem;
      margin-bottom: 2rem;
      display: flex;
      gap: 2rem;
      flex-wrap: wrap;
    }

    .stat-item {
      display: flex;
      flex-direction: column;
    }

    .stat-label {
      color: var(--color-grey-500);
      font-size: 0.9rem;
      margin-bottom: 0.3rem;
    }

    .stat-value {
      color: var(--color-grey-900);
      font-size: 1.5rem;
      font-weight: 700;
    }

    /* ========================================= */
    /* TABLA */
    /* ========================================= */
    .table-container {
      overflow-x: auto;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 1rem;
    }

    thead {
      background-color: var(--color-grey-900);
      color: var(--color-white);
    }

    th {
      padding: 1rem;
      text-align: left;
      font-weight: 700;
      font-size: 0.9rem;
    }

    td {
      padding: 1rem;
      border-bottom: 1px solid var(--color-green-200);
      color: var(--color-grey-900);
      font-size: 0.95rem;
    }

    tbody tr:hover {
      background-color: var(--color-green-200);
      cursor: pointer;
    }

    /* ========================================= */
    /* BADGES */
    /* ========================================= */
    .badge {
      display: inline-block;
      padding: 0.3rem 0.8rem;
      border-radius: 1rem;
      font-size: 0.85rem;
      font-weight: 700;
    }

    .badge-general {
      background-color: hsl(200, 100%, 90%);
      color: hsl(200, 100%, 30%);
    }

    .badge-soporte {
      background-color: hsl(280, 100%, 90%);
      color: hsl(280, 100%, 30%);
    }

    .badge-si {
      background-color: hsl(148, 100%, 90%);
      color: var(--color-green-600);
    }

    .badge-no {
      background-color: hsl(0, 100%, 95%);
      color: var(--color-red);
    }

    /* ========================================= */
    /* MENSAJE VACÍO */
    /* ========================================= */
    .empty-state {
      text-align: center;
      padding: 3rem 1rem;
      color: var(--color-grey-500);
    }

    .empty-state img {
      width: 100px;
      opacity: 0.5;
      margin-bottom: 1rem;
    }

    /* ========================================= */
    /* RESPONSIVE */
    /* ========================================= */
    @media (max-width: 768px) {
      .admin-container {
        padding: 1.5rem;
      }

      h1 {
        font-size: 1.5rem;
      }

      table {
        font-size: 0.85rem;
      }

      th, td {
        padding: 0.7rem;
      }

      .stats {
        flex-direction: column;
        gap: 1rem;
      }
    }

    /* ========================================= */
    /* SCROLLBAR PERSONALIZADA */
    /* ========================================= */
    .table-container::-webkit-scrollbar {
      height: 8px;
    }

    .table-container::-webkit-scrollbar-track {
      background: var(--color-green-200);
      border-radius: 10px;
    }

    .table-container::-webkit-scrollbar-thumb {
      background: var(--color-grey-500);
      border-radius: 10px;
    }

    .table-container::-webkit-scrollbar-thumb:hover {
      background: var(--color-grey-900);
    }
  </style>
</head>
<body>

  <div class="admin-container">
    
    <!-- ENCABEZADO -->
    <div class="admin-header">
      <h1>📬 Panel de Administración</h1>
      <a href="index.php" class="btn-volver">← Volver al formulario</a>
    </div>

    <!-- ESTADÍSTICAS -->
    <div class="stats">
      <div class="stat-item">
        <span class="stat-label">Total de envíos</span>
        <span class="stat-value"><?php echo mysqli_num_rows($resultado); ?></span>
      </div>
      <div class="stat-item">
        <span class="stat-label">Última actualización</span>
        <span class="stat-value"><?php echo date('d/m/Y H:i'); ?></span>
      </div>
    </div>

    <!-- TABLA DE ENVÍOS -->
    <div class="table-container">
      <?php if (mysqli_num_rows($resultado) > 0): ?>
        
        <table>
          <thead>
            <tr>
              <th>ID</th>
              <th>Nombre Completo</th>
              <th>Email</th>
              <th>Tipo Consulta</th>
              <th>Mensaje</th>
              <th>Consentimiento</th>
              <th>Fecha Envío</th>
            </tr>
          </thead>
          <tbody>
            <?php while($fila = mysqli_fetch_assoc($resultado)): ?>
              <tr>
                <td><strong>#<?php echo $fila['id']; ?></strong></td>
                <td><?php echo htmlspecialchars($fila['nombre'] . ' ' . $fila['apellido']); ?></td>
                <td><?php echo htmlspecialchars($fila['email']); ?></td>
                <td>
                  <?php if ($fila['tipo_consulta'] == 'consulta_general'): ?>
                    <span class="badge badge-general">Consulta General</span>
                  <?php else: ?>
                    <span class="badge badge-soporte">Solicitud Soporte</span>
                  <?php endif; ?>
                </td>
                <td style="max-width: 300px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                  <?php echo htmlspecialchars($fila['mensaje']); ?>
                </td>
                <td>
                  <?php if ($fila['consentimiento'] == 1): ?>
                    <span class="badge badge-si">Sí</span>
                  <?php else: ?>
                    <span class="badge badge-no">No</span>
                  <?php endif; ?>
                </td>
                <td><?php echo date('d/m/Y H:i', strtotime($fila['fecha_envio'])); ?></td>
              </tr>
            <?php endwhile; ?>
          </tbody>
        </table>

      <?php else: ?>
        
        <!-- ESTADO VACÍO -->
        <div class="empty-state">
          <svg width="100" height="100" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="50" cy="50" r="45" stroke="#B8CFD9" stroke-width="2" stroke-dasharray="5 5"/>
            <path d="M30 50L45 65L70 35" stroke="#B8CFD9" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
          <h2 style="color: var(--color-grey-500); margin-top: 1rem;">No hay envíos todavía</h2>
          <p style="color: var(--color-grey-500); margin-top: 0.5rem;">Los formularios enviados aparecerán aquí</p>
        </div>

      <?php endif; ?>
    </div>

  </div>

</body>
</html>

<?php
// Cerrar la conexión
mysqli_close($conn);
?>