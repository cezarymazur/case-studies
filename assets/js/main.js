window.addEventListener(
	'DOMContentLoaded',
	function () {
		// Page Title
		this.document.title = 'Hmmh | Case Studies'
		function focus() {
			this.document.title = 'Hmmh | Case Studies'
		}
		function blur() {
			this.document.title = 'Come back and see our Case Studies!'
		}

		this.window.addEventListener('blur', blur)
		this.window.addEventListener('focus', focus)

		// Case Studies Filter

		const filterButtons = this.document.querySelectorAll(
			'.case-studies__filter--type'
		)
		const caseStudies = this.document.querySelectorAll('article.case-study')
		console.log(caseStudies)
		filterButtons.forEach(singleButton => {
			singleButton.addEventListener('click', function () {
				filterButtons.forEach(btn => btn.classList.remove('active'))
				this.classList.add('active')
				const buttonType = this.dataset.type.toLowerCase()
				console.log(buttonType)
				caseStudies.forEach(function (caseStudy) {
					const caseStudyType = caseStudy.dataset.type.toLowerCase()
					if (buttonType.includes('all')) {
						caseStudy.style.display = 'block'
						return
					}
					if (caseStudyType.includes(buttonType)) {
						caseStudy.style.display = 'block'
					} else {
						caseStudy.style.display = 'none'
					}
				})
			})
		})
	},
	false
)
