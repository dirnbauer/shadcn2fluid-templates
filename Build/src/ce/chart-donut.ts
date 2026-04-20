import ApexCharts from 'apexcharts';

type DonutDatum = { label: string; value: number };

function cssVar(name: string, fallback: string): string {
  const v = getComputedStyle(document.documentElement).getPropertyValue(name).trim();
  return v || fallback;
}

function parseChartData(raw: string | undefined): DonutDatum[] {
  if (!raw) return [];
  const trimmed = raw.trim();
  if (!trimmed) return [];

  // Primary: JSON array of { label, value }
  if (trimmed.startsWith('[')) {
    try {
      const parsed = JSON.parse(trimmed);
      if (Array.isArray(parsed)) {
        return parsed
          .map((d: { label?: unknown; value?: unknown }) => ({
            label: String(d.label ?? ''),
            value: Number(d.value ?? 0),
          }))
          .filter((d) => Number.isFinite(d.value));
      }
    } catch {
      /* fall through to pipe-format tolerance */
    }
  }

  // Fallback: "label1|label2|label3\nvalue1|value2|value3"
  const lines = trimmed.split(/\r?\n/).filter(Boolean);
  if (lines.length >= 2) {
    const labels = lines[0].split('|').map((s) => s.trim());
    const values = lines[1].split('|').map((s) => Number(s.trim()));
    return labels.map((label, i) => ({ label, value: values[i] ?? 0 }));
  }
  return [];
}

function render(el: HTMLElement): void {
  const canvas = el.querySelector<HTMLElement>('[data-chart-donut-canvas]');
  if (!canvas) return;
  const data = parseChartData(el.dataset.chartData);
  if (data.length === 0) return;

  const showLegend = el.dataset.showLegend === 'true';
  const colors = [
    cssVar('--chart-1', '#10b981'),
    cssVar('--chart-2', '#3b82f6'),
    cssVar('--chart-3', '#8b5cf6'),
    cssVar('--chart-4', '#f59e0b'),
    cssVar('--chart-5', '#ef4444'),
  ];

  const chart = new ApexCharts(canvas, {
    chart: {
      type: 'donut',
      height: 300,
      fontFamily: cssVar('--font-sans', 'ui-sans-serif, system-ui, sans-serif'),
    },
    series: data.map((d) => d.value),
    labels: data.map((d) => d.label),
    colors,
    stroke: { width: 2, colors: [cssVar('--card', '#fff')] },
    dataLabels: { enabled: false },
    legend: {
      show: showLegend,
      position: 'bottom',
      labels: { colors: cssVar('--foreground', '#0a0a0a') },
      markers: { size: 6 },
    },
    plotOptions: {
      pie: {
        donut: {
          size: '70%',
          labels: {
            show: true,
            name: {
              show: true,
              color: cssVar('--muted-foreground', '#737373'),
              fontSize: '14px',
            },
            value: {
              show: true,
              color: cssVar('--foreground', '#0a0a0a'),
              fontSize: '24px',
              fontWeight: 700,
              formatter: (v: string) => v,
            },
            total: {
              show: true,
              showAlways: false,
              label: el.dataset.centerLabel ?? 'Total',
              color: cssVar('--muted-foreground', '#737373'),
              fontSize: '14px',
              formatter: () => el.dataset.centerValue ?? String(data.reduce((s, d) => s + d.value, 0)),
            },
          },
        },
      },
    },
    tooltip: {
      theme: document.documentElement.classList.contains('dark') ? 'dark' : 'light',
    },
  });

  chart.render();
}

function init(): void {
  document.querySelectorAll<HTMLElement>('[data-ce="chart-donut"]').forEach(render);
}

if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', init);
} else {
  init();
}
