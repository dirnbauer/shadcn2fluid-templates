(() => {
    const SVG_NS = 'http://www.w3.org/2000/svg';
    const CHART_WIDTH = 500;
    const CHART_HEIGHT = 300;
    const CHART_SELECTOR = '.shadcn-chart[data-chart-data]';
    const numberFormatter = new Intl.NumberFormat();

    const createSvgElement = (tagName, attributes = {}) => {
        const element = document.createElementNS(SVG_NS, tagName);

        Object.entries(attributes).forEach(([attributeName, attributeValue]) => {
            if (attributeValue === undefined || attributeValue === null || attributeValue === '') {
                return;
            }

            element.setAttribute(attributeName, String(attributeValue));
        });

        return element;
    };

    const appendSvgText = (parent, tagName, text, attributes = {}) => {
        const element = createSvgElement(tagName, attributes);
        element.textContent = String(text);
        parent.append(element);

        return element;
    };

    const normalizeData = (rawData) => {
        if (!Array.isArray(rawData) || rawData.length === 0) {
            return [{ label: 'No data', value: 0 }];
        }

        return rawData.map((point, index) => {
            const value = Number(point?.value);
            const label = typeof point?.label === 'string' && point.label.trim() !== ''
                ? point.label.trim()
                : `Point ${index + 1}`;

            return {
                label,
                value: Number.isFinite(value) ? value : 0,
            };
        });
    };

    const buildPath = (points) => points
        .map((point, index) => `${index === 0 ? 'M' : 'L'}${point.x},${point.y}`)
        .join(' ');

    const renderChart = (container) => {
        if (container.dataset.chartInitialized === 'true') {
            return;
        }

        const svg = container.querySelector('svg');
        const tooltip = container.querySelector('.shadcn-chart__tooltip');
        const tooltipLabel = tooltip?.querySelector('.shadcn-chart__tooltip-label');
        const tooltipValue = tooltip?.querySelector('.shadcn-chart__tooltip-value');

        if (!(svg instanceof SVGElement) || !(tooltip instanceof HTMLElement) || !(tooltipLabel instanceof HTMLElement) || !(tooltipValue instanceof HTMLElement)) {
            return;
        }

        let rawData;
        try {
            rawData = JSON.parse(container.dataset.chartData ?? '[]');
        } catch (error) {
            console.warn('ShadCN Chart: invalid JSON data.', error);
            rawData = [{ label: 'Error', value: 0 }];
        }

        const chartData = normalizeData(rawData);
        const showGrid = container.dataset.showGrid !== 'false';
        const fillType = container.dataset.fillType === 'solid' ? 'solid' : 'gradient';
        const chartId = container.dataset.chartId || 'chart';
        const padding = { top: 20, right: 20, bottom: 40, left: 50 };
        const chartWidth = CHART_WIDTH - padding.left - padding.right;
        const chartHeight = CHART_HEIGHT - padding.top - padding.bottom;
        const values = chartData.map((point) => point.value);
        const maxValue = Math.max(...values, 0) * 1.1 || 1;
        const valueRange = maxValue || 1;
        const chartPoints = chartData.map((point, index) => ({
            x: padding.left + (index / Math.max(chartData.length - 1, 1)) * chartWidth,
            y: padding.top + chartHeight - (point.value / valueRange) * chartHeight,
            label: point.label,
            value: point.value,
        }));

        const gridCount = 5;
        const gridLines = Array.from({ length: gridCount + 1 }, (_, index) => {
            const value = (valueRange * index) / gridCount;

            return {
                y: padding.top + chartHeight - (index / gridCount) * chartHeight,
                value: Math.round(value),
            };
        });

        const linePath = buildPath(chartPoints);
        const bottomY = CHART_HEIGHT - padding.bottom;
        const areaPath = `${linePath} L${chartPoints[chartPoints.length - 1].x},${bottomY} L${chartPoints[0].x},${bottomY} Z`;
        const fragment = document.createDocumentFragment();
        const defs = createSvgElement('defs');
        const gradient = createSvgElement('linearGradient', {
            id: `gradient-${chartId}`,
            x1: '0%',
            y1: '0%',
            x2: '0%',
            y2: '100%',
        });

        gradient.append(
            createSvgElement('stop', { offset: '0%', class: 'shadcn-chart__gradient-start' }),
            createSvgElement('stop', { offset: '100%', class: 'shadcn-chart__gradient-end' }),
        );
        defs.append(gradient);
        fragment.append(defs);

        if (showGrid) {
            const gridGroup = createSvgElement('g', { class: 'shadcn-chart__grid' });

            gridLines.forEach((line) => {
                gridGroup.append(createSvgElement('line', {
                    x1: padding.left,
                    y1: line.y,
                    x2: CHART_WIDTH - padding.right,
                    y2: line.y,
                    class: 'shadcn-chart__grid-line',
                }));
            });

            chartPoints.forEach((point) => {
                gridGroup.append(createSvgElement('line', {
                    x1: point.x,
                    y1: padding.top,
                    x2: point.x,
                    y2: bottomY,
                    class: 'shadcn-chart__grid-line shadcn-chart__grid-line--vertical',
                }));
            });

            fragment.append(gridGroup);
        }

        const yAxisGroup = createSvgElement('g', { class: 'shadcn-chart__axis shadcn-chart__axis--y' });
        gridLines.forEach((line) => {
            appendSvgText(yAxisGroup, 'text', line.value, {
                x: padding.left - 8,
                y: line.y + 4,
                class: 'shadcn-chart__axis-label',
                'text-anchor': 'end',
            });
        });
        fragment.append(yAxisGroup);

        const xAxisGroup = createSvgElement('g', { class: 'shadcn-chart__axis shadcn-chart__axis--x' });
        chartPoints.forEach((point) => {
            appendSvgText(xAxisGroup, 'text', point.label, {
                x: point.x,
                y: bottomY + 20,
                class: 'shadcn-chart__axis-label',
                'text-anchor': 'middle',
            });
        });
        fragment.append(xAxisGroup);

        fragment.append(createSvgElement('path', {
            d: areaPath,
            class: 'shadcn-chart__area',
            fill: fillType === 'gradient' ? `url(#gradient-${chartId})` : null,
        }));

        fragment.append(createSvgElement('path', {
            d: linePath,
            class: 'shadcn-chart__line',
            fill: 'none',
        }));

        const pointsGroup = createSvgElement('g', { class: 'shadcn-chart__points' });
        chartPoints.forEach((point) => {
            const circle = createSvgElement('circle', {
                cx: point.x,
                cy: point.y,
                r: 4,
                class: 'shadcn-chart__point',
            });

            circle.addEventListener('mouseenter', () => {
                const svgRect = svg.getBoundingClientRect();
                const scaleX = svgRect.width / CHART_WIDTH;
                const scaleY = svgRect.height / CHART_HEIGHT;

                tooltipLabel.textContent = point.label;
                tooltipValue.textContent = numberFormatter.format(point.value);
                tooltip.style.display = 'block';
                tooltip.style.left = `${point.x * scaleX}px`;
                tooltip.style.top = `${(point.y * scaleY) - 10}px`;
            });

            circle.addEventListener('mouseleave', () => {
                tooltip.style.display = 'none';
            });

            pointsGroup.append(circle);
        });
        fragment.append(pointsGroup);

        svg.replaceChildren(fragment);
        container.dataset.chartInitialized = 'true';
    };

    const initializeCharts = () => {
        document.querySelectorAll(CHART_SELECTOR).forEach((chart) => {
            if (chart instanceof HTMLElement) {
                renderChart(chart);
            }
        });
    };

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initializeCharts, { once: true });
    } else {
        initializeCharts();
    }
})();
