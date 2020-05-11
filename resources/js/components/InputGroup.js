import React from 'react'
import ReactDOM from 'react-dom'
import PropTypes from 'prop-types'

class InputGroup extends React.Component {
    constructor (props) {
        super(props)
        this.handleAdd = this.handleAdd.bind(this)
        this.handleRemove = this.handleRemove.bind(this)
        this.state = {
            currentNumberOfInputs: 2,
        }
    }

    handleAdd () {
        const { currentNumberOfInputs } = this.state

        this.setState({ currentNumberOfInputs: currentNumberOfInputs + 1 })
    }

    handleRemove () {
        const { currentNumberOfInputs } = this.state

        this.setState({ currentNumberOfInputs: currentNumberOfInputs - 1 })
    }

    render () {
        const inputs = []

        for (let i = 0; i < this.state.currentNumberOfInputs; i++) {
            inputs.push(
                <div key={i}>
                    <label className="sr-only" htmlFor={`option${i}`}>{`Option ${i + 1}`}</label>
                    <div className={`mt-1.5 rounded-md shadow-sm ${i !== 0 && 'mt-2'}`}>
                        <input className="form-input block w-full" id={`option${i}`} name={`options[${i}][name]`} type="text" placeholder={`Option ${i + 1}`} autoComplete="none" required={i < 2} />
                    </div>
                </div>,
            )
        }

        return (
            <div>
                {inputs}
                <div className="flex justify-end">
                    {this.state.currentNumberOfInputs > this.props.minNumberOfInputs &&
                        <button className="flex items-center mt-2 px-2.5 py-1.5 border border-transparent text-xs leading-4 font-medium rounded text-red-700 bg-red-100 hover:bg-red-50" type="button" onClick={this.handleRemove}>Remove Option</button>
                    }
                    {this.state.currentNumberOfInputs < this.props.maxNumberOfInputs &&
                        <button className="flex items-center mt-2 ml-2 px-2.5 py-1.5 border border-transparent text-xs leading-4 font-medium rounded text-green-700 bg-green-100 hover:bg-green-50" type="button" onClick={this.handleAdd}>Add Option</button>
                    }
                </div>
            </div>
        )
    }
}

InputGroup.propTypes = {
    minNumberOfInputs: PropTypes.string.isRequired,
    maxNumberOfInputs: PropTypes.number.isRequired,
}

if (document.getElementById('input-group')) {
    ReactDOM.render(<InputGroup minNumberOfInputs={2} maxNumberOfInputs={5} />, document.getElementById('input-group'))
}
