class Cities {
  constructor(jsOpen, phpOpen) {
    jsOpen.addEventListener('click', async () => {
      await this.jsFilterWork();
    });

    phpOpen.addEventListener('click', async () => {
      await this.phpFilterWork();
    });
  }

  async jsFilterWork() {
    const popupParams = this.createPopup('Фильтрация на фронте');

    let elements = [];
    try {
      const response = await fetch('/cities');
      elements = await response.json();
    } catch (e) {

    }
    popupParams.input.addEventListener('input', (event) => {
      const value = event.target.value;

      this.showCities(popupParams.list, elements.filter((city) => city.name.toLowerCase().indexOf(value.toLowerCase()) !== -1), value.length > 0);
    });

    document.body.append(popupParams.popup);
  }

  async phpFilterWork() {
    const popupParams = this.createPopup('Фильтрация на бэке');

    let timer;
    let elements = [];

    popupParams.input.addEventListener('input', (event) => {
      const value = event.target.value;

      clearTimeout(timer);
      timer = setTimeout(async () => {
        const response = await fetch(`/cities?query=${value}`);
        elements = await response.json();

        this.showCities(popupParams.list, elements, value.length > 0);
      }, 500);
    });

    document.body.append(popupParams.popup);
  }

  showCities(listBlock, list, show) {
    listBlock.textContent = '';

    if(show) {
      if (list.length === 0) {
        listBlock.append(this.createElement('li', ['result_city'], 'Нет результата'));
      } else {
        list.forEach((city) => {
          listBlock.append(this.createElement('li', ['result_city'], city.name));
        });
      }
    }
  }

  closePopup(popup) {
    popup.remove();
  }

  createPopup(title) {
    const resultInput = this.createElement('input', ['result__input'], null, {
      placeholder: 'Начините вводить название города',
      type: 'text'
    })
    const resultLabel = this.createElement('div', ['result__label'], null, null, [resultInput]);
    const resultList = this.createElement('div', ['result__list']);
    const content = this.createElement('div', ['popup__content'], null, null, [resultLabel, resultList]);

    const headerTitle = this.createElement('div', ['popup__title'], title);
    const headerClose = this.createElement('button', ['popup__close']);
    const header = this.createElement('div', ['popup__header'], null, null, [headerTitle, headerClose]);

    const body = this.createElement('div', ['popup__body'], null, null, [header, content]);
    const background = this.createElement('div', ['popup__background']);

    const popup = this.createElement('div', ['popup'], null, null, [background, body]);

    background.addEventListener('click', () => this.closePopup(popup));
    headerClose.addEventListener('click', () => this.closePopup(popup));

    return {
      popup,
      list: resultList,
      input: resultInput,
    }
  }

  createElement(tag, classes, content, attributes, children) {
    const element = document.createElement(tag);

    if (classes && classes.length > 0) {
      element.classList.add(...classes);
    }

    if (content) {
      element.textContent = content;
    }

    if (attributes) {
      for (const key in attributes) {
        element.setAttribute(key, attributes[key]);
      }
    }

    if (children) {
      for (const key in children) {
        element.append(children[key]);
      }
    }

    return element;
  }
}

document.addEventListener('DOMContentLoaded', () => {
  const jsButton = document.querySelector('.open-popup_js');
  const phpButton = document.querySelector('.open-popup_php');
  const popup = document.querySelector('.popup');

  new Cities(jsButton, phpButton, popup);
});
