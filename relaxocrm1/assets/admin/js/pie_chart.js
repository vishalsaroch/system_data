$(function () {
    var data = [],
        series = Math.floor(Math.random() * 6) + 3;

    for (var i = 0; i < series; i++) {
        data[i] = {
            label: "Series" + (i + 1),
            data: Math.floor(Math.random() * 100) + 1
        }
    }
    var placeholder = $("#placeholder");
    $("#example-5").click(function () {

        placeholder.unbind();

        $("#title").text("Label Styles #1");
        $("#description").text("Semi-transparent, black-colored label background.");

        $.plot(placeholder, data, {
            series: {
                pie: {
                    show: true,
                    radius: 1,
                    label: {
                        show: true,
                        radius: 3 / 4,
                        formatter: labelFormatter,
                        background: {
                            opacity: 0.5,
                            color: "#000"
                        }
                    }
                }
            },
            legend: {
                show: false
            }
        });

        setCode([
            "$.plot('#placeholder', data, {",
            "    series: {",
            "        pie: { ",
            "            show: true,",
            "            radius: 1,",
            "            label: {",
            "                show: true,",
            "                radius: 3/4,",
            "                formatter: labelFormatter,",
            "                background: { ",
            "                    opacity: 0.5,",
            "                    color: '#000'",
            "                }",
            "            }",
            "        }",
            "    },",
            "    legend: {",
            "        show: false",
            "    }",
            "});"
        ]);
    });
    // Show the initial default chart
    $("#example-5").click();
    // Add the Flot version string to the footer
});

// A custom label formatter used by several of the plots

function labelFormatter(label, series) {
    return "<div style='font-size:8pt; text-align:center; padding:2px; color:white;'>" + label + "<br/>" + Math.round(series.percent) + "%</div>";
}
//

function setCode(lines) {
    $("#code").text(lines.join("\n"));
}
