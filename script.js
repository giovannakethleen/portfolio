// =====================================
// CAMPO DE ESTRELAS (CANVAS)
// =====================================
const canvas = document.getElementById("stars-canvas")
const ctx = canvas.getContext("2d")

let stars = [],
  shootingStars = [],
  trailStars = []

const mouse = { x: -1000, y: -1000, prevX: -1000, prevY: -1000, vx: 0, vy: 0 }

window.addEventListener("mousemove", (e) => {
  mouse.prevX = mouse.x
  mouse.prevY = mouse.y
  mouse.x = e.clientX
  mouse.y = e.clientY
  mouse.vx = mouse.x - mouse.prevX
  mouse.vy = mouse.y - mouse.prevY
  spawnDust()
})
window.addEventListener("mouseleave", () => {
  mouse.x = -1000
  mouse.y = -1000
})

function resizeCanvas() {
  canvas.width = window.innerWidth
  canvas.height = window.innerHeight
  generateStars()
}

function generateStars() {
  const count = Math.floor((canvas.width * canvas.height) / 6000)
  stars = Array.from({ length: count }, () => ({
    x: Math.random() * canvas.width,
    y: Math.random() * canvas.height,
    radius: Math.random() * 1.4 + 0.2,
    alpha: Math.random(),
    speed: Math.random() * 0.015 + 0.003,
    dir: Math.random() > 0.5 ? 1 : -1,
  }))
}

function maybeShootingStar() {
  if (Math.random() < 0.0025 && shootingStars.length < 2) {
    shootingStars.push({
      x: Math.random() * canvas.width,
      y: Math.random() * canvas.height * 0.4,
      length: Math.random() * 120 + 80,
      speed: Math.random() * 8 + 6,
      angle: Math.PI / 5,
      life: 1,
    })
  }
}

let lastDust = 0
function spawnDust() {
  const now = performance.now()
  const spd = Math.hypot(mouse.vx, mouse.vy)
  if (spd < 1.2 || now - lastDust < 28) return
  lastDust = now

  const colors = ["167,139,250", "96,165,250", "34,211,238", "244,244,255"]
  const count = Math.min(Math.floor(spd / 4) + 1, 3)
  for (let i = 0; i < count; i++) {
    trailStars.push({
      x: mouse.x + (Math.random() - 0.5) * 6,
      y: mouse.y + (Math.random() - 0.5) * 6,
      radius: Math.random() * 1.8 + 0.6,
      color: colors[Math.floor(Math.random() * colors.length)],
      vx: (Math.random() - 0.5) * 0.6 + mouse.vx * 0.04,
      vy: (Math.random() - 0.5) * 0.6 + mouse.vy * 0.04,
      life: 1,
      decay: Math.random() * 0.015 + 0.012,
    })
  }
  if (trailStars.length > 80) trailStars.splice(0, trailStars.length - 80)
}

function draw() {
  ctx.clearRect(0, 0, canvas.width, canvas.height)

  // Estrelas fixas
  stars.forEach((s) => {
    s.alpha += s.speed * s.dir
    if (s.alpha <= 0.1 || s.alpha >= 1) s.dir *= -1
    ctx.beginPath()
    ctx.arc(s.x, s.y, s.radius, 0, Math.PI * 2)
    ctx.fillStyle = `rgba(255,255,255,${s.alpha})`
    ctx.fill()
  })

  // Estrelas cadentes
  maybeShootingStar()
  shootingStars.forEach((s, i) => {
    const dx = Math.cos(s.angle) * s.length
    const dy = Math.sin(s.angle) * s.length
    const g = ctx.createLinearGradient(s.x, s.y, s.x - dx, s.y - dy)
    g.addColorStop(0, `rgba(190,170,255,${s.life})`)
    g.addColorStop(1, "rgba(190,170,255,0)")
    ctx.beginPath()
    ctx.strokeStyle = g
    ctx.lineWidth = 2
    ctx.moveTo(s.x, s.y)
    ctx.lineTo(s.x - dx, s.y - dy)
    ctx.stroke()
    s.x += Math.cos(s.angle) * s.speed
    s.y += Math.sin(s.angle) * s.speed
    s.life -= 0.012
    if (s.life <= 0 || s.x > canvas.width + 200) shootingStars.splice(i, 1)
  })

  // Poeira do cursor
  trailStars.forEach((s, i) => {
    const r = s.radius * (1 + (1 - s.life) * 1.5)
    const g = ctx.createRadialGradient(s.x, s.y, 0, s.x, s.y, r * 4)
    g.addColorStop(0, `rgba(${s.color},${s.life * 0.5})`)
    g.addColorStop(1, `rgba(${s.color},0)`)
    ctx.beginPath()
    ctx.arc(s.x, s.y, r * 4, 0, Math.PI * 2)
    ctx.fillStyle = g
    ctx.fill()
    ctx.beginPath()
    ctx.arc(s.x, s.y, r, 0, Math.PI * 2)
    ctx.fillStyle = `rgba(${s.color},${s.life})`
    ctx.fill()
    s.x += s.vx
    s.y += s.vy
    s.vx *= 0.96
    s.vy *= 0.96
    s.life -= s.decay
    if (s.life <= 0) trailStars.splice(i, 1)
  })

  requestAnimationFrame(draw)
}

window.addEventListener("resize", resizeCanvas)
resizeCanvas()
draw()

// =====================================
// REVEAL AO ROLAR
// =====================================
document
  .querySelectorAll(
    ".skill-card, .project-card, .contact-channel, .section-title, .lead-text",
  )
  .forEach((el) => {
    el.classList.add("reveal")
    new IntersectionObserver(
      ([entry], obs) => {
        if (entry.isIntersecting) {
          el.classList.add("active")
          obs.unobserve(el)
        }
      },
      { threshold: 0.15 },
    ).observe(el)
  })

// =====================================
// NAVBAR SOMBRA
// =====================================
const navbar = document.querySelector(".custom-navbar")
window.addEventListener("scroll", () => {
  navbar.style.boxShadow =
    window.scrollY > 30 ? "0 4px 20px rgba(0,0,0,0.3)" : "none"
})

// =====================================
// FECHAR MENU MOBILE
// =====================================
document.querySelectorAll("#navMenu .nav-link").forEach((link) => {
  link.addEventListener("click", () => {
    const menu = document.getElementById("navMenu")
    if (menu.classList.contains("show")) {
      ;(
        bootstrap.Collapse.getInstance(menu) || new bootstrap.Collapse(menu)
      ).hide()
    }
  })
})
